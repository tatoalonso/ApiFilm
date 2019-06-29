<?php

namespace MyApp\Component\ApiFilm\Application\UseCases;



use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;

class ListActorsUseCase
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }
    public function listAll(): array
    {
        return $this->actorRepository->findAll();
    }

}