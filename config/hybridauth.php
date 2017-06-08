<?php
use Cake\Core\Configure;
return [
    'HybridAuth' => [
        'providers' => [
            'Google' => [
                'enabled' => true,
                'keys' => [
                    'id' => '<google-client-id>',
                    'secret' => '<secret-key>'
                ]
            ],
            'Facebook' => [
                'enabled' => true,
                'keys' => [
                    'id' => '852620488226769',
                    'secret' => '6cfdedf0f211b7a0fe614bafd1bd7327'
                ],
                'scope' => 'email, user_about_me, user_birthday, user_hometown'
                //'email, user_about_me, user_birthday, user_hometown'
            ],
            'Twitter' => [
                'enabled' => true,
                'keys' => [
                    'key' => 'ruYoDJPOse78FpA3oN5dYvKGI',
                    'secret' => 'zXlkpJkUy0kX2JPIADCf31Y9qUJzDUCTxmwQK6F4C8I2rbTAf7'
                ],
                'includeEmail' => true // Only if your app is whitelisted by Twitter Support
            ]
        ],
        'debug_mode' => Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log',
    ]
];
?>