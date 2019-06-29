<?php


namespace MyApp\Component\ApiFilm\Domain;

use InvalidArgumentException;

class Film
{
    private const MAX_NAME_LENGTH = 200;

    private $id;
    private $name;
    private $description;
    private $actor;

    public function __construct(string $name, string $description, Actor $actor)
    {
        $this->name =$this->validateName($name);
        $this->description = $this->validateDescription($description);
        $this->actor = $actor->validateActor($actor);

    }

    private function validateName(string $name): string
    {

        $name = filter_var($name, FILTER_SANITIZE_STRING);

        if ($name === ''){

            throw new InvalidArgumentException('name can not be empty');

        }

        $nameLength = mb_strlen($name);

        if ($nameLength > self::MAX_NAME_LENGTH) {

            throw new InvalidArgumentException('name too long');

        }

        return $name;
    }

    private function validateDescription(string $description): string
    {
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        if ($description === ''){

            throw new InvalidArgumentException('description can not be empty');

        }

        return $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {

        $this->name =$this->validateName($name);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {

        $this->description = $this->validateDescription($description);

    }

    public function getActor():Actor
    {
        return $this->actor;
    }

    public function setActor(Actor $actor): void
    {
        $this->actor = $actor->validateActor($actor);
    }

    public function filmToArray(): array
    {
        $actor = $this->getActor();
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'actor' => $actor->actorToArray()
        ];
    }
}