<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Dotenv\Dotenv;

class LoadEnv extends Command
{
    protected $signature = 'env:load {file}';
    protected $description = 'Load a specific .env file';

    public function handle()
    {
        $file = $this->argument('file');
        $dotenv = Dotenv::createImmutable(base_path(), $file);
        $dotenv->load();
        $this->info("Loaded {$file} environment file.");
    }
}