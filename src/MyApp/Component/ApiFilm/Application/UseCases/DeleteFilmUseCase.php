<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmDeleted;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DeleteFilmUseCase
{
    private $filmRepository;
    private $dispatcher;

    public function __construct(FilmRepository $filmRepository,EventDispatcherInterface $dispatcher )
    {
        $this->filmRepository = $filmRepository;
        $this->dispatcher = $dispatcher;
    }
    public function deleteFilm(int $filmId): void
    {
         $this->filmRepository->deleteFilm($filmId);
         $this->dispatcher->dispatch(FilmDeleted::TOPIC, new FilmDeleted($filmId));
    }
}