<?php
return [
    'backend' => [
        'frontName' => 'admin_blink'
    ],
    'cache' => [
        'graphql' => [
            'id_salt' => 'ZklfWdLXrZRfPQ25DGFtbSdS48c51yfh'
        ],
        'frontend' => [
            'default' => [
                'id_prefix' => 'f69_'
            ],
            'page_cache' => [
                'id_prefix' => 'f69_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => 'c1fe81176b1d31c430a58d05f89e3ac2'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'blinkapp_M2db',
                'username' => 'blinkapp_M2User',
                'password' => 'TA_XydyOZlD@',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'default',
    'session' => [
        'save' => 'files'
    ],
    'lock' => [
        'provider' => 'db'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'amasty_blog' => 1
    ],
    'downloadable_domains' => [
        'blinkapp.ecomsoft.co.in'
    ],
    'install' => [
        'date' => 'Fri, 08 Dec 2023 18:28:24 +0000'
    ]
];
