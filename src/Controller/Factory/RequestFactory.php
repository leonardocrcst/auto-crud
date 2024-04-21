<?php

namespace App\Controller\Factory;

use App\Controller\Dto\Request;
use App\Controller\Trait\RequestUri;

abstract class RequestFactory
{
    use RequestUri;

    public static function getFromRequestUri(string $host, int $position = 0): ?Request
    {
        $items = self::requestUriToArray($host);
        if (count($items) > $position) {
            return Request::getFromUri($items[$position]);
        }
        return null;
    }

    public static function getResource(string $host = '/api'): ?Request
    {
        return self::getFromRequestUri($host);
    }

    public static function getAction(string $host = '/api'): ?Request
    {
        return self::getFromRequestUri($host, 1);
    }

    /**
     * @param string $host
     * @return Request[]|null
     */
    public static function getParameters(string $host = '/api'): ?array
    {
        $parameters = null;
        $position = 2;
        do {
            $parameter = self::getFromRequestUri($host, $position);
            if (!empty($parameter)) {
                $parameters[] = $parameter;
            }
            $position++;
        } while (!empty($parameter));
        return $parameters;
    }
}