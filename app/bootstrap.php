<?php

// Define Mode
define('MODE', 'development');

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

// Define Root dir
define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';

// Create Slim app
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// Fetch DI Container
$container = $app->getContainer();

// Register config
$container['config'] = function($c) {
    return new \Noodlehaus\Config(ROOT . '/app/config/' . MODE . '.php');
};

// Middleware
$app->add(new \Market\Middlewares\BeforeMiddleware($container));
$app->add(new \Market\Middlewares\CsrfMiddleware($container));

// Add a flash tool
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(ROOT . '/resources/views', [
        'debug' => true
        // 'cache' => ROOT . '/storage/cache'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

require 'database.php';
require 'filters.php';
require 'routes.php';

$container['auth'] = false;

$container['user'] = function($c) {
    return new \Market\Models\User;
};

$container['hash'] = function($c) {
    return new \Market\Helpers\Hash($c->config);
};

$container['validator'] = function($c) {
    return new \Market\Validation\Validator($c->user, $c->hash, $c->auth);
};

$container['randomlib'] = function($c) {
    return (new \RandomLib\Factory)->getGenerator(new \SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
};
