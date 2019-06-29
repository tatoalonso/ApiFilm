<?php

namespace MyApp\Bundle\ApiFilmBundle\Actor\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use MyApp\Component\ApiFilm\Domain\Actor;
use MyApp\Component\ApiFilm\Domain\Repository\ActorRepository;


use Exception;

class MySqlActorRepository extends EntityRepository implements ActorRepository
{
    private $em;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    public function findAll():array
    {
        try{

        return $this->em->getRepository(Actor::class)->findAll();

        } catch (Exception $e) {
            return  $array = ["error" => "Se produjo un error"];

        }
    }

    public function saveActor(Actor $actor): ?array
    {
        try {

            $this->em->persist($actor);
            $this->em->flush();

            return null;

        } catch (Exception $e) {
            return  $array = ["error" => "Se produjo un error"];

        }
    }

    public function findActorById(int $actorId): Actor
    {
         $actor = $this->em->getRepository(Actor::class)->findOneBy(['id' => $actorId]);

         if (is_null($actor)){

             throw new Exception('Se produjo un error');
         }

         return $actor;

    }

    public function deleteActor(int $idActor): void
    {
        try{

            $actor = $this->em->getReference(Actor::class, $idActor);
            $this->em->remove($actor);
            $this->em->flush();


        } catch (Exception $e) {

            throw new Exception('Se produjo un error');

        }
    }



}