<?php

namespace MyApp\Bundle\ApiFilmBundle\Actor\Controller;

use Exception;
use MyApp\Component\ApiFilm\Application\Dto\ActorDto;
use MyApp\Component\ApiFilm\Application\UseCases\ListActorsUseCase;
use MyApp\Component\ApiFilm\Application\UseCases\RegisterNewActorUseCase;
use MyApp\Component\ApiFilm\Domain\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use MyApp\Bundle\ApiFilmBundle\Actor\Repository\MySqlActorRepository;

class ActorController extends Controller
{

    public function newActor(Request $request):Response
    {

        $json = json_decode($request->getContent(), true);


        $registerNewActorUseCase = $this->get('app.apifilm.usecase.newactor');
        $actorDto = new ActorDto((string)$json['name']);
        $result = $registerNewActorUseCase -> registerActor($actorDto);


        if (!isset($result['error'])){

            return new Response('New actor was added!', 201);

        }else{
            return new Response($result['error'], 400);
        }

    }

    public function listActor() :JsonResponse
    {

        $listActorsUseCase = $this->get('app.apifilm.usecase.listactors');
        $actors = $listActorsUseCase->listAll();

        if (!isset($actors['error'])){
            $actorsAsArray = array_map(function (Actor $actor) {

                return $actor->actorToArray();

            }, $actors);

            return new JsonResponse($actorsAsArray);
        }else{
            return new JsonResponse($actors['error'], 400);
        }
    }

    public function deleteActor($id) : Response
    {

        try {

            $deleteActorUseCase = $this->get('app.apifilm.usecase.deleteactor');
            $deleteActorUseCase->deleteActor($id);

            return new Response('Actor deleted!', 200);

        }catch (Exception $e) {

            throw new Exception('Se produjo un error'.$e->getMessage());
        }

    }

    public function listActorHtml($id)
    {
        $listActorByIdUseCase = $this->get('app.apifilm.usecase.listactorbyid');
        $actor = $listActorByIdUseCase->findActorById($id);
        $actor =$actor->actorToArray();

        return $this->render("actor/listActorHtml.html.twig", $actor);

    }


}