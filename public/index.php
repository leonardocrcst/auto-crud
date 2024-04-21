<?php

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

(Dotenv::createImmutable(__DIR__ . '/../'))->load();

$routes = require_once __DIR__ . '/../config/routes.php';

$app = AppFactory::create();
$routes($app);
$app->run();