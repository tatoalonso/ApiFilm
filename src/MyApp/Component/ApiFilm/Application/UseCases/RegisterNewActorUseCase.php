<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Application\Dto\ActorDto;
use MyApp\Component\ApiFilm\Domain\Actor;

use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;

class RegisterNewActorUseCase
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }
    public function registerActor(ActorDto $dto): ?array
    {
        $actor = new Actor($dto->getName());
        return $this->actorRepository->saveActor($actor);

    }

}