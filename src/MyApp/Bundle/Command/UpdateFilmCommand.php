<?php


namespace MyApp\Bundle\Command;


use MyApp\Component\ApiFilm\Application\Dto\FilmDto;
use MyApp\Component\ApiFilm\Application\UseCases\UpdateFilmUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateFilmCommand extends Command
{

    private $updateFilmUseCase;

    public function __construct(UpdateFilmUseCase $updateFilmUseCase)
    {
        parent::__construct();
        $this->updateFilmUseCase = $updateFilmUseCase;
    }
    protected function configure()
    {
        $this
            ->setName("film:update")
            ->setDescription("Update a existing Film")
            ->addArgument(
                "filmId"
                , InputArgument::REQUIRED
                , "The Film Id"
            )->addArgument(
                "name"
                , InputArgument::REQUIRED
                , "The Film name"
            )->addArgument(
                "description",
                InputArgument::REQUIRED,
                "The Film description"
            )->addArgument(
                "actorId",
                InputArgument::REQUIRED,
                "The Film actor id"
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filmId = filter_var($input->getArgument('filmId'), FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($input->getArgument('name') , FILTER_SANITIZE_STRING);
        $description = filter_var($input->getArgument("description") ,FILTER_SANITIZE_STRING);
        $actorId = filter_var($input->getArgument('actorId'), FILTER_SANITIZE_NUMBER_INT);

        $filmDto = new FilmDto($name, $description, $actorId);

        $this->updateFilmUseCase->updateFilm($filmId,$filmDto);
        $output->writeln("Film updated!");
    }

}