<?php

namespace MyApp\Component\ApiFilm\Domain\Repository;

use MyApp\Component\ApiFilm\Domain\Film;


interface FilmRepository
{

    public function saveFilm(Film $film): ?array;
    public function deleteFilm(int $idFilm): void;
    public function updateFilm(Film $film): void;
    public function findFilmById (int $filmId): Film;
    public function findAll (): array;
    public function findFilmsByActor(int $idActor):array;

}