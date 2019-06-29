<?php

namespace MyApp\Component\ApiFilm\Application\Dto;


class ActorDto
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
}