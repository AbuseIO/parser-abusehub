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
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Botnet Drone' => [
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Microsoft Sinkhole HTTP Drone' => [
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'KPN ShadowServer Drone Report' => [
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open Proxy' => [
            'class'     => 'OPEN_PROXY_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Botnet DDOS' => [
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open DNS Resolvers' => [
            'class'     => 'OPEN_DNS_RESOLVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Command and Control' => [
            'class'     => 'BOTNET_CONTROLLER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Sandbox url' => [
            'class'     => 'SPAMTRAP',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Spam url' => [
            'class'     => 'SPAM',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open SNMP' => [
            'class'     => 'OPEN_SNMP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver NTP Version' => [
            'class'     => 'OPEN_NTP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open NetBIOS' => [
            'class'     => 'OPEN_NETBIOS_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open SSDP' => [
            'class'     => 'OPEN_SSDP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open CharGen' => [
            'class'     => 'OPEN_CHARGEN_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open QOTD' => [
            'class'     => 'OPEN_QOTD_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver NTP Version' => [
            'class'     => 'OPEN_NTP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Compromised Website' => [
            'class'     => 'COMPROMISED_WEBSITE',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver NTP Monitor' => [
            'class'     => 'OPEN_NTP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver IPMI' => [
            'class'     => 'OPEN_IMPI_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver SSLv3/Poodle Vulnerable Servers' => [
            'class'     => 'SSLV3_VULNERABLE_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer Vulnerable NAT-PMP Systems report' => [
            'class'     => 'OPEN_NATPMP_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer Open Memcached Server Report' => [
            'class'     => 'OPEN_MEMCACHED_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer Open Redis Servers Report' => [
            'class'     => 'OPEN_REDIS_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Shadowserver Open MS-SQL Server Resolution Service Report' => [
            'class'     => 'OPEN_MSSQL_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer Open MongoDB Service Report' => [
            'class'     => 'OPEN_MONGODB_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer SSL/Freak Vulnerable Servers report' => [
            'class'     => 'FREAK_VULNERABLE_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ShadowServer Open Elasticsearch Server Report' => [
            'class'     => 'OPEN_ELASTICSEARCH_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ACM' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'ACM Possible Malware' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'AOL FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'CleanMX' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'COX FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Google Safe Browsing' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Lotus FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Hotmail FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC RAT Report' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Brobot URL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Ebury Infections' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Mongodb report' => [
            'class'     => 'OPEN_MONGODB_SERVER',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Cryptoware infections' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Mumblehard infections' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'NCSC Mumblehartt' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Rackspace FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Spamhaus Bot Report' => [
            'class'     => 'BOTNET_INFECTION',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Team Cymru Malevolence Monitoring' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'Terra FBL' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],
        'TrendMicro' => [
            'class'     => 'DEFAULT',
            'type'      => 'ABUSE',
            'enabled'   => true,
            'fields'    => [
                'src_ip',
                'event_date',
                'event_time',
            ],
        ],

    ],
];
