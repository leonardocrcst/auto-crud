<?php

use App\Controller\Router;
use Slim\App;

return function (App $app) {
    $app->map(
        ["GET", "POST", "PUT", "PATCH", "DELETE"],
        "/api[/[{route:.*}]]",
        Router::class
    );
};