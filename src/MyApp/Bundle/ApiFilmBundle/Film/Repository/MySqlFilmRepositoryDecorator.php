<?php


namespace MyApp\Bundle\ApiFilmBundle\Film\Repository;

use MyApp\Bundle\Services\CacheService;
use MyApp\Component\ApiFilm\Domain\Film;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;

class MySqlFilmRepositoryDecorator implements FilmRepository
{
    private $filmRepository;
    private $cacheService;

    public function __construct(FilmRepository $filmRepository ,CacheService $cacheService)
    {
        $this->filmRepository = $filmRepository;
        $this->cacheService = $cacheService;
    }
    public function findAll():array
    {


        if (!$this->cacheService->existInCache(CacheService::FILMS_LIST_KEY)) {

            $filmsList = $this->filmRepository->findAll();

            $this->cacheService->saveInCache(CacheService::FILMS_LIST_KEY, $filmsList);

            return $filmsList;
        }

        return $this->cacheService->getCacheItem(CacheService::FILMS_LIST_KEY);

    }

    public function saveFilm(Film $film): ?array
    {

        return $this->filmRepository->saveFilm($film);

    }

    public function deleteFilm(int $idFilm): void
    {

        $this->filmRepository->deleteFilm($idFilm);

    }

    public function updateFilm(Film $film): void
    {

         $this->filmRepository->updateFilm($film);

    }

    public function findFilmById(int $filmId):Film
    {

        if (!$this->cacheService->existInCache(CacheService::FILM_KEY.(string)$filmId)) {


            $film = $this->filmRepository->findFilmById($filmId);

            $this->cacheService->saveInCache(CacheService::FILM_KEY.(string)$filmId, $film);

            return $film;

        }

        return $this->cacheService->getCacheItem(CacheService::FILM_KEY.(string)$filmId);

    }

    public function findFilmsByActor(int $actorId):array
    {

        return  $this->filmRepository->findFilmsByActor($actorId);

    }
}