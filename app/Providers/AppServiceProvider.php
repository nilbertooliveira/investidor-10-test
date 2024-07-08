<?php

namespace App\Providers;

use App\Application\Services\CategoryService;
use App\Application\Services\NewsService;
use App\Domains\Interfaces\Repositories\ICategoryRepository;
use App\Domains\Interfaces\Repositories\INewsRepository;
use App\Domains\Interfaces\Services\ICategoryService;
use App\Domains\Interfaces\Services\INewsService;
use App\Infrastructure\Repositories\CategoryRepository;
use App\Infrastructure\Repositories\NewsRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(INewsService::class, NewsService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(INewsRepository::class, NewsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
        Factory::guessModelNamesUsing(function ($string) {
            return 'App\\Infrastructure\\Database\\Models\\' . str_replace('Factory', '', class_basename($string));
        });
    }
}
