<?php


namespace MyApp\Component\ApiFilm\Application\EventSuscriber;



use Symfony\Component\EventDispatcher\Event;

class FilmCreated extends Event
{

    const TOPIC = 'film.created';



}