<?php


namespace MyApp\Bundle\Services;

use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmCreated;
use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmDeleted;
use MyApp\Component\ApiFilm\Application\EventSuscriber\FilmUpdated;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class CacheService
{
    const NAMESPACE = '';
    const LIFETIME = 0;
    const FILMS_LIST_KEY = 'films_list';
    const FILM_KEY = 'film_';


    private $cacheService;

    public function __construct()
    {
        $this->cacheService = new FilesystemAdapter(self::NAMESPACE,self::LIFETIME);
    }

    public function getCacheItem(string $key)
    {
        $cacheValue = $this->cacheService->getItem($key);
        return $cacheValue->get();
    }


    public function existInCache(string $key): bool
    {
        $cacheValue = $this->cacheService->getItem($key);
        return ($cacheValue->isHit());
    }

    public function saveInCache(string $key, $value): void
    {
        if ($this->existInCache($key)) {

            $this->cleanCacheItem($key);
        }

        $cacheValue = $this->cacheService->getItem($key);
        $cacheValue->set($value);
        $this->cacheService->save($cacheValue);
    }


    public function onFilmCreated(): void
    {
        $this->cacheService->deleteItem(self::FILMS_LIST_KEY);

    }

    public function onFilmUpdated(FilmUpdated $filmUpdatedEvent): void
    {
        $key = self::FILM_KEY.$filmUpdatedEvent->getIdFilmDeleted();

        $this->cacheService->deleteItem($key);
        $this->cacheService->deleteItem(self::FILMS_LIST_KEY);
    }

    public function onFilmDeleted(FilmDeleted $filmDeletedEvent): void
    {

        $key = self::FILM_KEY.$filmDeletedEvent->getIdFilmDeleted();

        $this->cacheService->deleteItem($key);
        $this->cacheService->deleteItem(self::FILMS_LIST_KEY);


    }

    public function onActorDeleted(): void
    {
        $this->cleanCache();
    }

    public function cleanCacheItem(string $key): void
    {
        $this->cacheService->deleteItem($key);
    }

    public function cleanCache(): void
    {
        $this->cacheService->clear();
    }

}
