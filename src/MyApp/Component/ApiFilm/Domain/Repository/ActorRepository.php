<?php

namespace MyApp\Component\ApiFilm\Domain\Repository;

use MyApp\Component\ApiFilm\Domain\Actor;

interface ActorRepository
{

    public function saveActor(Actor $actor) :?array;
    public function findAll(): array;
    public function findActorById(int $actorId): Actor;
    public function deleteActor(int $idActor): void;

}