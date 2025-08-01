<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AppSeed extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'app:seed';
    protected $description = 'Seeds the database with initial categories and articles data';

    public function run(array $params)
    {
        CLI::write('Starting database seeding...', 'yellow');
        
        try {
            // Run the main database seeder
            $seeder = \Config\Database::seeder();
            $seeder->call('DatabaseSeeder');
            
            CLI::write('Database seeding completed successfully!', 'green');
        } catch (\Exception $e) {
            CLI::error($e->getMessage());
            CLI::write('Database seeding failed!', 'red');
        }
    }
}
