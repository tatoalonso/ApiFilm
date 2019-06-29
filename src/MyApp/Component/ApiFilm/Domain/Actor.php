<?php


namespace MyApp\Component\ApiFilm\Domain;

use InvalidArgumentException;

class Actor
{
    private const MAX_NAME_LENGTH = 200;

    private $id;
    private $name;

    public function __construct(string $name)
    {
        $this->name =$this->validateName($name);

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

    private function validateName(string $name): string
    {

        $name = filter_var($name, FILTER_SANITIZE_STRING);

        if ($name === '') {

            throw new InvalidArgumentException('name can not be empty');

        }

        $nameLength = mb_strlen($name);

        if ($nameLength > self::MAX_NAME_LENGTH) {

            throw new InvalidArgumentException('name too long');

        }

        return $name;

    }

    public function validateActor(Actor $actor): Actor
    {
        $actor->validateName($actor->getName());
        return $actor;
    }

    public function actorToArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName()
        ];
    }
}