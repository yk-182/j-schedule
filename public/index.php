<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// autoload参照
require __DIR__ . '/../vendor/autoload.php';

//session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/config/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/config/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/config/middleware.php';
$middleware($app);

// Constants
$constants = require __DIR__ . '/../src/config/constants.php';

// Register routes
$routes = require __DIR__ . '/../src/config/routes.php';
$routes($app);

// Run app
$app->run();
