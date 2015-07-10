<?php

return [
    'parser' => [
        'name'          => 'AbuseHub',
        'enabled'       => true,
        'report_file'   => '/^abusehubcsv\-.*\.csv/i',
        'sender_map'    => [
            '/reports@reports.abusehub.nl/',
        ],

        'body_map'      => [
            //
        ],
        'feeds' => [
            'Shadowserver Sinkhole HTTP Drone' => [
                'class'     => 'Shadowserver Sinkhole HTTP Drone',
                'fields'    => '',
                'type'      => 'Abuse',
                'enabled'   => true,
            ],
            'Shadowserver Botnet Drone' => [
                'class'     => 'Shadowserver Botnet Drone',
                'fields'    => '',
                'type'      => 'Abuse',
                'enabled'   => true,
            ],
            'Shadowserver Compromised Website' => [
                'class'     => 'Shadowserver Compromised Website',
                'fields'    => '',
                'type'      => 'Abuse',
                'enabled'   => true,
            ],
            'Shadowserver Microsoft Sinkhole HTTP Drone' => [
                'class'     => 'Shadowserver Microsoft Sinkhole HTTP Drone',
                'fields'    => '',
                'type'      => 'Abuse',
                'enabled'   => true,
            ],
        ],
    ],
];
