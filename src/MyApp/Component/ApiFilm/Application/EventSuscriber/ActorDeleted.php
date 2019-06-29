<?php


namespace MyApp\Component\ApiFilm\Application\EventSuscriber;


use Symfony\Component\EventDispatcher\Event;

class ActorDeleted extends Event
{

    const TOPIC = 'actor.deleted';


}