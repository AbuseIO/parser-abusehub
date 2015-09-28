<?php

namespace AbuseIO\Parsers;

use Ddeboer\DataImport\Reader;
use SplFileObject;
use ReflectionClass;
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
        // Generalize the local config based on the parser class name.
        $reflect = new ReflectionClass($this);
        $this->configBase = 'parsers.' . $reflect->getShortName();

        Log::info(
            get_class($this). ': Received message from: '.
            $this->parsedMail->getHeader('from') . " with subject: '" .
            $this->parsedMail->getHeader('subject') . "' arrived at parser: " .
            config("{$this->configBase}.parser.name")
        );

        // Define array where all events are going to be saved in.
        $events = [ ];

        foreach ($this->parsedMail->getAttachments() as $attachment) {
            // Only use the Abusehub formatted csv, skip all others
            if (!preg_match(config("{$this->configBase}.parser.report_file"), $attachment->filename)) {
                continue;
            }

            // Create temporary working environment for the parser ($this->tempPath, $this->fs)
            $this->createWorkingDir();
            file_put_contents($this->tempPath . $attachment->filename, $attachment->getContent());

            $csvReader = new Reader\CsvReader(new SplFileObject($this->tempPath . $attachment->filename));
            $csvReader->setHeaderRowNumber(0);

            foreach ($csvReader as $report) {
                if (empty($report['report_type'])) {
                    return $this->failed(
                        "Unabled to detect feed because of required field report_type is missing"
                    );
                }

                $feedName = $report['report_type'];

                // If feed is known and enabled, validate data and save report
                if ($this->isKnownFeed($feedName) && $this->isEnabledFeed($feedName)) {
                    // Sanity checks (skip if required fields are unset)
                    if ($this->hasRequiredFields($feedName, $report) === true) {
                        $events[] = [
                            'source'        => config("{$this->configBase}.parser.name"),
                            'ip'            => $report['src_ip'],
                            'domain'        => false,
                            'uri'           => false,
                            'class'         => config("{$this->configBase}.feeds.{$feedName}.class"),
                            'type'          => config("{$this->configBase}.feeds.{$feedName}.type"),
                            'timestamp'     => strtotime($report['event_date'] .' '. $report['event_time']),
                            'information'   => json_encode($report),
                        ];
                    } else {
                        return $this->failed(
                            "Required field {$this->requiredField} is missing in the report or config is incorrect."
                        );
                    }
                } else {
                    return $this->failed(
                        "Detected feed '{$feedName}' is unknown or disabled."
                    );
                }
            }
        }

        return $this->success($events);
    }
}
