<?php
namespace Code2be\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Code2be\Fixtures\User;

class FixturesCommand extends Command
{
    protected function configure() {
        $this
            ->setName('fixtures:load')
            ->setDescription('Load fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        User::load();
        $output->writeln('User fixture loaded');
    }
}
