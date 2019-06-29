<?php

namespace MyApp\Component\ApiFilm\Application\UseCases;

use MyApp\Component\ApiFilm\Application\Dto\FilmDto;
use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmCreated;
use MyApp\Component\ApiFilm\Domain\Film;
use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


class RegisterNewFilmUseCase
{
    private $filmRepository;
    private $actorRepository;
    private $dispatcher;


    public function __construct( ActorRepository $actorRepository, FilmRepository $filmRepository ,EventDispatcherInterface $dispatcher)
    {
        $this->actorRepository = $actorRepository;
        $this->filmRepository = $filmRepository;
        $this->dispatcher = $dispatcher;

    }
    public function registerFilm(FilmDto $dto): ?array
    {

        $actor = $this->actorRepository->findActorById($dto->getActorId());
        $film = new Film($dto->getName(), $dto->getDescription(), $actor);
        $this->dispatcher->dispatch(FilmCreated::TOPIC, new FilmCreated());
        return $this->filmRepository->saveFilm($film);



    }
}