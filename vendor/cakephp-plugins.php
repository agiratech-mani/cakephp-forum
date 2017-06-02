<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'AgiraForum' => $baseDir . '/plugins/AgiraForum/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/'
    ]
];