<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Notícias Gerais', 'description' => 'Notícias Gerais'],
            ['name' => 'Esporte', 'description' => 'Esporte'],
            ['name' => 'Política', 'description' => 'Política'],
            ['name' => 'Entretenimento', 'description' => 'Entretenimento'],
            ['name' => 'Tecnologia', 'description' => 'Tecnologia'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                [
                    'name' => $category['name']
                ],
                $category
            );
        }
    }
}
