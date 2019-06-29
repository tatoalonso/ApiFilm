<?php


namespace MyApp\Bundle\ApiFilmBundle\Film\Repository;

use Doctrine\ORM\EntityManagerInterface;
use MyApp\Component\ApiFilm\Domain\Film;
use Doctrine\ORM\EntityRepository;
use MyApp\Component\ApiFilm\Domain\Repository\FilmRepository;

use Exception;


class MySqlFilmRepository extends EntityRepository implements FilmRepository

{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    public function findAll():array
    {
        try{

            return $this->em->getRepository(Film::class)->findAll();

        } catch (Exception $e) {
            return  $array = ["error" => "Se produjo un error"];

        }
    }

    public function saveFilm(Film $film): ?array
    {
        try {

            $this->em->persist($film);
            $this->em->flush();

            return null;

        } catch (Exception $e) {
            return  $array = ["error" => "Se produjo un error"];

        }
    }

    public function deleteFilm(int $idFilm): void
    {
        try{

            $film = $this->em->getReference(Film::class, $idFilm);
            $this->em->remove($film);
            $this->em->flush();



        } catch (Exception $e) {

            throw new Exception('Se produjo un error');

        }
    }

    public function updateFilm(Film $film): void
    {

        try{

            //$this->saveFilm($film);
            $this->em->flush();

        } catch (Exception $e) {

            throw new Exception('Se produjo un error');

        }
    }

    public function findFilmById(int $filmId):Film
    {
        $film = $this->em->getRepository(Film::class)->findOneBy(['id' => $filmId]);

        if (is_null($film)){

            throw new Exception('Se produjo un error');
        }

        return $film;
    }

    public function findFilmsByActor(int $actorId):array
    {
        try {

            return $this->em->getRepository(Film::class)->findBy(['actor' => $actorId]);

        } catch (Exception $e) {

            throw new Exception('Se produjo un error');

        }
    }
}