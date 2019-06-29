<?php


namespace MyApp\Bundle\Command;


use MyApp\Component\ApiFilm\Application\UseCases\DeleteFilmUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteFilmCommand extends Command
{
    private $deleteFilmUseCase;

    public function __construct(DeleteFilmUseCase $deleteFilmUseCase)
    {
        parent::__construct();
        $this->deleteFilmUseCase= $deleteFilmUseCase;
    }
    protected function configure()
    {
        $this
            ->setName("film:delete")
            ->setDescription("Delete a existing Film")
            ->addArgument(
                "filmId"
                , InputArgument::REQUIRED
                , "The Film Id"

            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filmId = filter_var($input->getArgument('filmId'), FILTER_SANITIZE_NUMBER_INT);

        $this->deleteFilmUseCase->deleteFilm($filmId);

        $output->writeln("Film deleted!");
    }



}