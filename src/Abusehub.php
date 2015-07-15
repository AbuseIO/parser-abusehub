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

    public function __construct($parsedMail, $arfMail, $config = false)
    {
        $this->configFile = __DIR__ . '/../config/' . basename(__FILE__);
        $this->config = $config;
        $this->parsedMail = $parsedMail;
        $this->arfMail = $arfMail;
    }

    public function parse()
    {
        Log::info(
            get_class($this). ': Received message from: '.
            $this->parsedMail->getHeader('from') . " with subject: '" .
            $this->parsedMail->getHeader('subject') . "' arrived at parser: " .
            $this->config['parser']['name']
        );

        $events = [ ];

        foreach ($this->parsedMail->getAttachments() as $attachment) {
            // Only use the Abusehub formatted csv, skip all others
            if (!preg_match($this->config['parser']['report_file'], $attachment->filename)) {
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
                $infoBlob = [];

                // Only parse known feeds
                $feed = $row['report_type'];

                if (!isset($this->config['parser']['feeds'][$feed])) {
                    $filesystem->deleteDirectory($tempPath);
                    return $this->failed(
                        "Detected feed '${feed}' is unknown. No sense in trying to parse."
                    );
                } else {
                    $feedConfig = $this->config['parser']['feeds'][$feed];
                }

                // Only parse enabled feeds
                if ($feedConfig['enabled'] !== true) {
                    $filesystem->deleteDirectory($tempPath);
                    return $this->failed(
                        "Detected feed '${feed}' has been disabled by configuration."
                    );

                }

                // Fill the infoBlob. 'fields' in the feeds' config is empty, get all fields.
                $csv_colums = array_filter($feedConfig['fields']);
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
                    'source'        => $this->config['parser']['name'],
                    'ip'            => $row['src_ip'],
                    'domain'        => '',
                    'uri'           => '',
                    'class'         => $feedConfig['class'],
                    'type'          => $feedConfig['type'],
                    'timestamp'     => strtotime($row['event_date'] .' '. $row['event_time']),
                    'information'   => json_encode($infoBlob),
                ];

                $events[] = $event;

            }
        }

        return $this->success($events);
    }
}
