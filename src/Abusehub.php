<?php

namespace AbuseIO\Parsers;

use Ddeboer\DataImport\Reader;
use Ddeboer\DataImport\Writer;
use Ddeboer\DataImport\Filter;
use Illuminate\Filesystem\Filesystem;
use SplFileObject;
use Uuid;
use Log;

class Abusehub extends Parser
{
    public $parsedMail;
    public $arfMail;

    /**
     * Create a new Abusehub instance
     */
    public function __construct($parsedMail, $arfMail)
    {
        $this->parsedMail = $parsedMail;
        $this->arfMail = $arfMail;
    }

    /**
     * Parse attachments
     * @return Array    Returns array with failed or success data
     *                  (See parser-common/src/Parser.php) for more info.
     */
    public function parse()
    {
        Log::info(
            get_class($this). ': Received message from: '.
            $this->parsedMail->getHeader('from') . " with subject: '" .
            $this->parsedMail->getHeader('subject') . "' arrived at parser: " .
            config('Abusehub.parser.name')
        );

        $events = [ ];

        foreach ($this->parsedMail->getAttachments() as $attachment) {
            // Only use the Abusehub formatted csv, skip all others
            if (!preg_match(config('Abusehub.parser.report_file'), $attachment->filename)) {
                continue;
            }

            $tempUUID = Uuid::generate(4);
            $tempPath = "/tmp/${tempUUID}/";
            $filesystem = new Filesystem;

            if (!$filesystem->makeDirectory($tempPath)) {
                return $this->failed("Unable to create directory ${tempPath}");
            }

            file_put_contents($tempPath . $attachment->filename, $attachment->getContent());

            $csvReader = new Reader\CsvReader(new SplFileObject($tempPath . $attachment->filename));
            $csvReader->setHeaderRowNumber(0);

            foreach ($csvReader as $row) {
                $infoBlob = [ ];

                // Only parse known feeds
                $feedName = $row['report_type'];

                // If this type of feed does not exist, throw error
                if (empty(config("Abusehub.feeds.{$feedName}"))) {
                    $filesystem->deleteDirectory($tempPath);
                    return $this->failed(
                        "Detected feed '{$feedName}' is unknown."
                    );
                }

                // Only parse enabled feeds
                if (config("Abusehub.feeds.{$feedName}.enabled") !== true) {
                    $filesystem->deleteDirectory($tempPath);
                    continue;
                }

                // Fill the infoBlob. 'fields' in the feeds' config is empty, get all fields.
                $csv_colums = array_filter(config("Abusehub.feeds.{$feedName}.fields"));
                if (count($csv_colums) > 0) {
                    foreach ($csv_colums as $column) {
                        if (!isset($row[$column])) {
                            return $this->failed(
                                "Required field ${column} is missing in the CSV or config is incorrect."
                            );
                        } else {
                            $infoBlob[$column] = $row[$column];
                        }
                    }
                } else {
                    $infoBlob = $row;
                }

                // Basic required columns that reside in every CSV
                $requiredColumns = [
                    'src_ip',
                    'event_date',
                    'event_time',
                ];

                foreach ($requiredColumns as $column) {
                    if (!isset($row[$column])) {
                        return $this->failed(
                            "Required field ${column} is missing in the CSV or config is incorrect."
                        );
                    }
                }

                $event = [
                    'source'        => config('Abusehub.parser.name'),
                    'ip'            => $row['src_ip'],
                    'domain'        => false,
                    'uri'           => false,
                    'class'         => config("Abusehub.feeds.{$feedName}.class"),
                    'type'          => config("Abusehub.feeds.{$feedName}.type"),
                    'timestamp'     => strtotime($row['event_date'] .' '. $row['event_time']),
                    'information'   => json_encode($infoBlob),
                ];

                $events[] = $event;
            }
        }

        return $this->success($events);
    }
}
