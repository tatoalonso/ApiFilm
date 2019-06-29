<?php


namespace MyApp\Bundle\Command;


use MyApp\Component\ApiFilm\Application\UseCases\ListFilmsUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListFilmsCommand extends Command
{
    private $listFilmsUseCase;

    public function __construct(ListFilmsUseCase $listFilmsUseCase)
    {
        parent::__construct();
        $this->listFilmsUseCase = $listFilmsUseCase;
    }
    protected function configure()
    {
        $this
            ->setName("film:list")
            ->setDescription("Provide a list of the films");

    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $films = $this->listFilmsUseCase->listAll();

        $output->writeln([
            'Films List',
            '=========='
        ]);

        $i =0;

        foreach ($films as $film) {

            $i = $i + 1;

            $output->writeln('Film '. $i);
            $output->writeln('Id: ' . $film->getId());
            $output->writeln('Name: ' . $film->getName());
            $output->writeln('Description: ' . $film->getDescription());
            $output->writeln('Actor: ' . $film->getActor()->getName());
            $output->writeln('----------');


        }



        $output->writeln("<<<<< End of films >>>>>");
    }


}