<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Application\EventSuscriber\ActorDeleted;
use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DeleteActorUseCase
{

    private $filmRepository;
    private $actorRepository;
    private $dispatcher;


    public function __construct(ActorRepository $actorRepository, FilmRepository $filmRepository, EventDispatcherInterface $dispatcher)
    {
        $this->actorRepository = $actorRepository;
        $this->filmRepository = $filmRepository;
        $this->dispatcher = $dispatcher;

    }

    public function deleteActor(int $actorId): void
    {

        $films = $this->filmRepository->findFilmsByActor($actorId);

        foreach ($films as  $film) {

            $idFilm =$film->getId();
            $this->filmRepository->deleteFilm($idFilm);

        }

        $this->actorRepository->deleteActor($actorId);

        $this->dispatcher->dispatch(ActorDeleted::TOPIC, new ActorDeleted());
    }

}