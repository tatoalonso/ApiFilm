<?php


namespace MyApp\Component\ApiFilm\Application\EventSuscriber;


use Symfony\Component\EventDispatcher\Event;

class FilmDeleted extends Event
{

    const TOPIC = 'film.deleted';

    private $idFilmDeleted;


    public function __construct($idFilmDeleted)
    {
        $this->idFilmDeleted = $idFilmDeleted;
    }
    public function getIdFilmDeleted(): string
    {
        return $this->toString($this->idFilmDeleted);
    }
    public function toString($idFilmDeleted):string

    {
        return (string)$idFilmDeleted;
    }
}