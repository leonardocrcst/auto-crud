<?php

namespace App\Controller\Dto;

readonly class Property
{
    public function __construct(
        public string $name,
        public mixed $value
    ) {
    }

    public static function getFromUri(string $uri): ?Property
    {
        $exploded = explode('=', $uri);
        $name = array_shift($exploded);
        $value = true;
        if (count($exploded)) {
            $value = array_shift($exploded);
        }
        return new self($name, $value);
    }

    /**
     * @param string $uri
     * @return Property[]|null
     */
    public static function getAllFromUri(string $uri): ?array
    {
        return array_map(function ($chunk) {
            return self::getFromUri($chunk);
        }, explode('&', $uri));
    }
}