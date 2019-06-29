<?php


namespace MyApp\Bundle\Command;


use MyApp\Bundle\Services\CacheService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCacheCommand extends Command
{

    private $cacheService;

    public function __construct(CacheService $cacheService)
    {
        parent::__construct();
        $this->cacheService= $cacheService;
    }
    protected function configure()
    {
        $this
            ->setName("cache:delete")
            ->setDescription("Delete a existing Cache"
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->cacheService->cleanCache();

        $output->writeln("Cache deleted!");
    }

}