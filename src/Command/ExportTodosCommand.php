<?php

namespace App\Command;

use App\Interface\Exporter\TodosExporterInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:export-todos',
    description: 'Gets all Todos in the system and exports them to an external service through a rest API',
)]
class ExportTodosCommand extends Command
{
    public function __construct(
        private readonly TodosExporterInterface $todosExporter
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $exportedTodos = $this->todosExporter->export();

        $io->success(
            sprintf("You have successfully exported following todos. \n %s", $exportedTodos)
        );

        return Command::SUCCESS;
    }
}
