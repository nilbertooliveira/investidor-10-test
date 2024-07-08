<?php

namespace App\Application\Services;


use App\Domains\Interfaces\Services\IRedisService;


class RedisService implements IRedisService
{


    public function __construct()
    {

    }


    public function writeIndex(array $data): mixed
    {

    }


    public function deleteIndex(array $data): mixed
    {

    }

    /**
     * @param string $index
     * @param string $type
     * @param int $id
     * @return array
     */
    public function search(string $index, string $type, int $id): array
    {

    }


    public function indexAllProducts(): void
    {

    }
}
