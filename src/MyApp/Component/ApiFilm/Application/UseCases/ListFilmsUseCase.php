<?php

namespace MyApp\Component\ApiFilm\Application\UseCases;



use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;

class ListFilmsUseCase
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }
    public function listAll(): array
    {
        return $this->filmRepository->findAll();
    }
}