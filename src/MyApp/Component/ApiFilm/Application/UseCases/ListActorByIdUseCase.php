<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Domain\Actor;
use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;



class ListActorByIdUseCase
{

    private $actorRepository;


    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;

    }

    public function findActorById(int $actorId): Actor
    {

        return $this->actorRepository->findActorById($actorId);

    }

}