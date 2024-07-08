<?php

namespace App\Domains\Interfaces\Services;

use App\Application\Services\ResponseService;
use App\Domains\Interfaces\DTOInterface;

interface INewsService
{
    public function searchByTerm(string $term): ResponseService;

    public function list(): ResponseService;

    public function store(DTOInterface $newsDTO): ResponseService;

    public function update(DTOInterface $newsDTO): ResponseService;

    public function destroy(DTOInterface $newsDTO): ResponseService;
}
