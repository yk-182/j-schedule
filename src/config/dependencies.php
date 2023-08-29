<?php

use Slim\App;

return function (App $app) {

    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $formatter = new Monolog\Formatter\LineFormatter(null, 'Y-m-d H:i:s.u', null, true);
        $log_handler = new \Monolog\Handler\RotatingFileHandler('../logs/app.log', 21, $settings['level'], true, 0664);
        $log_handler->setFormatter($formatter);
        $logger->pushHandler($log_handler);
        return $logger;
    };
};
