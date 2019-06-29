<?php

namespace MyApp\Bundle\ApiFilmBundle\Film\Controller;

use MyApp\Bundle\ApiFilmBundle\Actor\Repository\MySqlActorRepository;;

use MyApp\Bundle\ApiFilmBundle\Film\Repository\MySqlFilmRepository;
use MyApp\Component\ApiFilm\Application\Dto\FilmDto;
use MyApp\Component\ApiFilm\Application\UseCases\RegisterNewFilmUseCase;
use MyApp\Component\ApiFilm\Domain\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;






class FilmController extends Controller
{

    public function newFilm(Request $request): Response
    {

        $json = json_decode($request->getContent(), true);

        try {


            $registerNewFilmUseCase = $this->get('app.apifilm.usecase.newfilm');
            $filmDto = new FilmDto((string)$json['name'], $json['description'], $json['actorId']);
            $registerNewFilmUseCase -> registerFilm($filmDto);


            return new Response('', 201);

            }catch (Exception $e) {

                throw new Exception('Se produjo un error');
            }


    }

    public function deleteFilm($id) : Response
    {

        try {

            $deleteFilmUseCase = $this->get('app.apifilm.usecase.deletefilm');
            $deleteFilmUseCase->deleteFilm($id);

            return new Response('Film deleted!', 200);

        }catch (Exception $e) {

            throw new Exception('Se produjo un error'.$e->getMessage());
        }

    }


    public function updateFilm(Request $request, $id):Response
    {

        $json = json_decode($request->getContent(), true);

        try {

            $updateFilmUseCase = $this->get('app.apifilm.usecase.updatefilm');
            $filmDto = new FilmDto((string)$json['name'], $json['description'], $json['actorId']);
            $updateFilmUseCase-> updateFilm($id,$filmDto);
            return new Response('Film updated!', 200);


        }catch (Exception $e) {

            throw new Exception($e->getMessage());
        }

    }

    public function listFilm():JsonResponse
    {

        $listFilmsUseCase = $this->get('app.apifilm.usecase.listfilms');
        $films = $listFilmsUseCase->listAll();


        if (!isset($films['error'])){
            $filmsAsArray = array_map(function (Film $film) {
                return $film->filmToArray();
            }, $films);

            return new JsonResponse($filmsAsArray);

        }else{
            return new JsonResponse($films['error'], 400);
        }

    }

    public function listFilmHtml($id)
    {
        $listFilmByIdUseCase = $this->get('app.apifilm.usecase.listfilmbyid');

        $film = $listFilmByIdUseCase->findFilmById($id);
        $film =$film->filmToArray();


        return $this->render("film/listFilmHtml.html.twig", array('film' => [$film]));

    }




}