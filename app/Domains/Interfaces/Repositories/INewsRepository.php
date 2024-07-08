<?php

namespace App\Domains\Interfaces\Repositories;

use App\Domains\Interfaces\DTOInterface;
use Illuminate\Database\Eloquent\Collection;

interface INewsRepository
{
    public function searchByTerm(string $term): Collection;

    public function list(): Collection;

    public function store(DTOInterface $newsDTO): DTOInterface;

    public function update(DTOInterface $newsDTO): bool;

    public function destroy(DTOInterface $newsDTO): bool;
}
