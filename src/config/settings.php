<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // falseでエラー表示を向こうにする。本番環境はfalse推奨
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'jlmc-app',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
