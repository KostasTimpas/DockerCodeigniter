<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $data = [
                'name'        => $faker->words(3, true),
                'description' => $faker->sentence(10),
                'price'       => $faker->randomFloat(2, 10, 1000),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            // Using Query Builder
            $this->db->table('products')->insert($data);
        }
    }
}
