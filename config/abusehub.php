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
    ],

    'feeds' => [
        'Shadowserver Sinkhole HTTP Drone' => [
            'class'     => 'Shadowserver Sinkhole HTTP Drone',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Botnet Drone' => [
            'class'     => 'Shadowserver Botnet Drone',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Compromised Website' => [
            'class'     => 'Shadowserver Compromised Website',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Microsoft Sinkhole HTTP Drone' => [
            'class'     => 'Shadowserver Microsoft Sinkhole HTTP Drone',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],
    ],
];
