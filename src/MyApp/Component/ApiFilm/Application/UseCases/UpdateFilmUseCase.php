<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Application\Dto\FilmDto;
use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmUpdated;
use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdateFilmUseCase
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
    public function updateFilm(int $idFilm, FilmDto $dto): void
    {
        $actor = $this->actorRepository->findActorById($dto->getActorId());

        $film = $this->filmRepository->findFilmById($idFilm);
        $film->setName($dto->getName());
        $film->setDescription($dto->getDescription());
        $film->setActor($actor);
        $this->filmRepository->updateFilm($film);

        $this->dispatcher->dispatch(FilmUpdated::TOPIC, new FilmUpdated($film->getId()));

    }



}