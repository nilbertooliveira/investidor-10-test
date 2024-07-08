<?php

namespace App\Domains\Interfaces\Repositories;

use App\Domains\Interfaces\DTOInterface;
use Illuminate\Database\Eloquent\Collection;

interface ICategoryRepository
{
    public function list(): Collection;

    public function store(DTOInterface $categoryDTO): DTOInterface;

    public function update(DTOInterface $categoryDTO): bool;

    public function destroy(DTOInterface $categoryDTO): bool;
}
