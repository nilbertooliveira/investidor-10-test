<?php

namespace App\Application\Commands;

use App\Domains\Interfaces\Services\IRedisService;
use Illuminate\Console\Command;

class IndexAllProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:index-all-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index all products from the database to Redis';

    /**
     * Execute the console command.
     */
    public function handle(IRedisService $elasticsearchService)
    {
        $elasticsearchService->indexAllProducts();
    }
}
