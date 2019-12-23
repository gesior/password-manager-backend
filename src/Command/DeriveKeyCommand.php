<?php

namespace App\Command;

use App\Service\ClientEncryption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeriveKeyCommand extends Command
{
    protected static $defaultName = 'app:derive-key';
    /**
     * @var ClientEncryption
     */
    private $clientEncryption;

    protected function configure()
    {
        $this
            ->setDescription('Simple derive key function')
            ->addArgument('password', InputArgument::REQUIRED, 'Plain text password')
            ->addArgument('iterations', InputArgument::REQUIRED, 'Iterations')
            ->addArgument('algorithm', InputArgument::REQUIRED, 'Algorithm')
            ->addArgument('length', InputArgument::REQUIRED, 'Bytes length');
    }

    public function __construct(ClientEncryption $clientEncryption)
    {
        parent::__construct(self::$defaultName);
        $this->clientEncryption = $clientEncryption;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $password = $input->getArgument('password');
        $iterations = intval($input->getArgument('iterations'));
        $algorithm = $input->getArgument('algorithm');
        $binaryLength = $input->getArgument('length');

        $startTime = microtime(true);
        $derivedKey = $this->clientEncryption->deriveKey($password, $iterations, $algorithm, $binaryLength);
        $endTime = microtime(true);

        $io->success('Time: ' . ($endTime - $startTime));
        $io->success('Key hex: ' . $derivedKey);
        $io->success('Key bin: ' . hex2bin($derivedKey));
    }

}
