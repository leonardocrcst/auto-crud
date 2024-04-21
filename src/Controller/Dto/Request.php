<?php

namespace App\Controller\Dto;

readonly class Request
{
    /**
     * @param string $value
     * @param Property[]|null $properties
     */
    public function __construct(
        public string $value,
        public ?array $properties = null
    ) {
    }

    public static function getFromUri(string $uri): ?Request
    {
        $exploded = explode('?', $uri);
        $value = ucfirst(array_shift($exploded));
        if (count($exploded)) {
            $properties = array_map(function ($property) {
                return Property::getAllFromUri($property);
            }, $exploded);
            return new self($value, $properties);
        }
        return new self($value);
    }
}