<?php

namespace App\Domains\Interfaces\Services;

use App\Application\Services\ResponseService;
use App\Domains\Interfaces\DTOInterface;

interface ICategoryService
{
    public function list(): ResponseService;

    public function store(DTOInterface $categoryDTO): ResponseService;

    public function update(DTOInterface $categoryDTO): ResponseService;

    public function destroy(DTOInterface $categoryDTO): ResponseService;
}
