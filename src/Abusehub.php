<?php

namespace AbuseIO\Parsers;

use Ddeboer\DataImport\Reader;
use SplFileObject;
use AbuseIO\Models\Incident;

/**
 * Class Abusehub
 * @package AbuseIO\Parsers
 */
class Abusehub extends Parser
{
    /**
     * Create a new Abusehub instance
     *
     * @param \PhpMimeMailParser\Parser phpMimeParser object
     * @param array $arfMail array with ARF detected results
     */
    public function __construct($parsedMail, $arfMail)
    {
        // Call the parent constructor to initialize some basics
        parent::__construct($parsedMail, $arfMail, $this);
    }

    /**
     * Parse attachments
     *
     * @return array    Returns array with failed or success data
     *                  (See parser-common/src/Parser.php) for more info.
     */
    public function parse()
    {
        foreach ($this->parsedMail->getAttachments() as $attachment) {
            // Only use the Abusehub formatted reports, skip all others
            if (preg_match(config("{$this->configBase}.parser.report_file"), $attachment->filename)) {
                // Create temporary working environment for the parser ($this->tempPath, $this->fs)
                $this->createWorkingDir();
                file_put_contents($this->tempPath . $attachment->filename, $attachment->getContent());

                $csvReader = new Reader\CsvReader(new SplFileObject($this->tempPath . $attachment->filename));
                $csvReader->setHeaderRowNumber(0);

                // Loop through all csv reports
                foreach ($csvReader as $report) {
                    if (!empty($report['report_type'])) {
                        $this->feedName = $report['report_type'];

                        // If feed is known and enabled, validate data and save report
                        if ($this->isKnownFeed() && $this->isEnabledFeed()) {
                            // Sanity check
                            if ($this->hasRequiredFields($report) === true) {
                                // incident has all requirements met, filter and add!
                                $report = $this->applyFilters($report);

                                $incident = new Incident();
                                $incident->source      = config("{$this->configBase}.parser.name");
                                $incident->source_id   = false;
                                $incident->ip          = $report['src_ip'];
                                $incident->domain      = false;
                                $incident->class       = config("{$this->configBase}.feeds.{$this->feedName}.class");
                                $incident->type        = config("{$this->configBase}.feeds.{$this->feedName}.type");
                                $incident->timestamp   = strtotime($report['event_date'] .' '. $report['event_time']);
                                $incident->information = json_encode($report);

                                $this->incidents[] = $incident;
                            }
                        }
                    } else {
                        // We cannot parse this report, since we haven't detected a report_type.
                        $this->warningCount++;
                    }
                } // end foreach: loop through csv lines
            } // end if: found report file to parse
        } // end foreach: loop through attachments

        return $this->success();
    }
}
