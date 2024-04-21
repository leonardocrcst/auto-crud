<?php

namespace App\Controller;

use App\Controller\Dto\Request;
use App\Controller\Factory\RequestFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $resource = RequestFactory::getResource();
        if ($this->hasResource($resource)) {
            $resource = RequestFactory::getResource();
            $action = RequestFactory::getAction();
            $parameters = RequestFactory::getParameters();
            $test = ['resource' => $resource, 'action' => $action, 'parameters' => $parameters];
            $response->getBody()->write(json_encode($test));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
        return $response->withStatus(404);
    }

    private function hasResource(?Request $resource = null): bool
    {
        if (empty($resource)) {
            return false;
        }
        $file = sprintf(
            "%s/%s.php",
            $_ENV['RESOURCE_DIR'],
            $resource->value
        );
        return file_exists($file);
    }
}