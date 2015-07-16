<?php

return [
    'parser' => [
        'name'          => 'Abusehub',
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
            'class'     => 'Botnet infection',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Botnet Drone' => [
            'class'     => 'Botnet infection',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Compromised Website' => [
            'class'     => 'Compromised website',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],

        'Shadowserver Microsoft Sinkhole HTTP Drone' => [
            'class'     => 'Botnet infection',
            'type'      => 'Abuse',
            'enabled'   => true,
            'fields'    => [
                //
            ],
        ],
    ],
];
