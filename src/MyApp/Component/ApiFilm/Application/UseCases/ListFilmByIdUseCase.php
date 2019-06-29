<?php


namespace MyApp\Component\ApiFilm\Application\UseCases;


use MyApp\Component\ApiFilm\Domain\Film;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;

class ListFilmByIdUseCase
{
    private $filmRepository;


    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;

    }

    public function findFilmById(int $filmId): Film
    {

        return $this->filmRepository->findFilmById($filmId);

    }


}