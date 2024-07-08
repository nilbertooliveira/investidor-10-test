<?php

namespace Database\Seeders;

use App\Infrastructure\Database\Models\Category;
use App\Infrastructure\Database\Models\News;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('pt_BR');
        $categories = Category::all(); // Obter todas as categorias

        for ($i = 1; $i <= 20; $i++) {
            $category = $categories->random(); // Selecionar uma categoria aleatória
            $news = [
                'title' => $faker->sentence(),
                'summary' => $faker->paragraph(5),
                'category_id' => $category->id, // ID da categoria selecionada
            ];

            News::create($news);
        }
    }
}
