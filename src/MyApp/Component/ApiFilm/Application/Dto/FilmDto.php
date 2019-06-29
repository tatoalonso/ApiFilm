<?php


namespace MyApp\Component\ApiFilm\Application\Dto;


class FilmDto
{
    private $name;
    private $description;
    private $actorId;

    public function __construct(string $name, string $description, int $actorId)
    {
        $this->name = $name;
        $this->description = $description;
        $this->actorId = $actorId;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }

}