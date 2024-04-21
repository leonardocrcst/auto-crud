<?php

namespace App\Controller\Trait;

trait RequestUri
{
    public static function requestUriToArray(string $ignore): array
    {
        $uri = str_replace($ignore, '', urldecode($_SERVER['REQUEST_URI']));
        return array_values(array_filter(explode('/', $uri)));
    }
}