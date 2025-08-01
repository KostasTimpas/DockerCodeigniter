<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // First seed categories
        $this->call('CategorySeeder');
        
        // Then seed articles and their relationships with categories
        $this->call('ArticleSeeder');
        
        echo "Seeding completed successfully!\n";
    }
}
