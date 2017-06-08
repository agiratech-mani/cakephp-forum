<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'ADmad/HybridAuth' => $baseDir . '/vendor/admad/cakephp-hybridauth/',
        'AgiraForum' => $baseDir . '/plugins/AgiraForum/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/'
    ]
];