<?php

namespace App\Command;

use Exception;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test-cloudinary',
    description: 'Directly tests the Cloudinary Flysystem connection.',
)]
class TestCloudinaryCommand extends Command
{
    private FilesystemOperator $storage;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        // 'defaultStorage' matches your 'default.storage' key in flysystem.yaml
        $this->storage = $defaultStorage;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Starting Cloudinary Connection Test');

        try {
            $fileName = 'test_from_symfony_' . time() . '.txt';
            $content = 'Connection successful at ' . date('Y-m-d H:i:s');

            $io->info("Attempting to write file: $fileName");

            $this->storage->write($fileName, $content);

            $io->success("File '$fileName' was successfully sent to Cloudinary!");
            $io->note("Please check your Cloudinary Media Library dashboard now.");
        } catch (Exception $e) {
            $io->error("Upload failed!");
            $io->writeln("Error Message: " . $e->getMessage());
            $io->writeln("File: " . $e->getFile());
            $io->writeln("Line: " . $e->getLine());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
