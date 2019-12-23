<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EncryptCommand extends Command
{
    protected static $defaultName = 'app:encrypt';

    protected function configure()
    {
        $this
            ->setDescription('Simple encryption function')
            ->addArgument('password', InputArgument::REQUIRED, 'Plain text password')
            ->addArgument('text', InputArgument::REQUIRED, 'Text to encrypt')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $password = $input->getArgument('password');
        $text = $input->getArgument('text');

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
