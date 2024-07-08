<?php

namespace App\Domains\Interfaces\Services;

interface IRedisService
{

    public function writeIndex(array $data): mixed;

    public function search(string $index, string $type, int $id): array;

    public function indexAllProducts(): void;
}
