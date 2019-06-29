<?php


namespace MyApp\Component\ApiFilm\Application\EventSuscriber;


use Symfony\Component\EventDispatcher\Event;

class FilmUpdated extends Event
{

    const TOPIC = 'film.updated';

    private $idFilmUpdated;


    public function __construct($idFilmUpdated)
    {
        $this->idFilmUpdated = $idFilmUpdated;
    }
    public function getIdFilmDeleted(): string
    {
        return $this->toString($this->idFilmUpdated);
    }
    public function toString($idFilmUpdated):string

    {
        return (string)$idFilmUpdated;
    }


}