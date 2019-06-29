<?php


namespace MyApp\Bundle\Command;

use MyApp\Component\ApiFilm\Application\Dto\FilmDto;
use MyApp\Component\ApiFilm\Application\UseCases\RegisterNewFilmUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterNewFilmCommand extends Command
{

    private $newFilmUseCase;

    public function __construct(RegisterNewFilmUseCase $newFilmUseCase)
    {
        parent::__construct();
        $this->newFilmUseCase = $newFilmUseCase;
    }
    protected function configure()
    {
        $this
            ->setName("film:create")
            ->setDescription("Register a new Film")
            ->addArgument(
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
        $name = filter_var($input->getArgument('name') , FILTER_SANITIZE_STRING);
        $description = filter_var($input->getArgument("description") ,FILTER_SANITIZE_STRING);
        $actorId = filter_var($input->getArgument('actorId'), FILTER_SANITIZE_NUMBER_INT);

        $filmDto = new FilmDto($name, $description, $actorId);

        $this->newFilmUseCase->registerFilm($filmDto);
        $output->writeln("Film created!");
    }

}