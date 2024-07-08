<?php

namespace App\Application\Services;

use App\Domains\Interfaces\DTOInterface;
use App\Domains\Interfaces\Repositories\ICategoryRepository;
use App\Domains\Interfaces\Services\ICategoryService;

class CategoryService implements ICategoryService
{
    private ICategoryRepository $categoryRepository;

    /**
     * @param ICategoryRepository $categoryRepository
     */
    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return ResponseService
     */
    public function list(): ResponseService
    {
        try {
            $categories = $this->categoryRepository->list();

            $result = new ResponseService($categories->getIterator()->getArrayCopy());
        } catch (\Throwable $e) {
            $result = new ResponseService($e->getMessage(), false);
        }
        return $result;
    }

    /**
     * @param DTOInterface $categoryDTO
     * @return ResponseService
     */
    public function store(DTOInterface $categoryDTO): ResponseService
    {
        try {
            $result = $this->categoryRepository->store($categoryDTO);

            return new ResponseService($result->jsonSerialize());
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @param DTOInterface $categoryDTO
     * @return ResponseService
     */
    public function update(DTOInterface $categoryDTO): ResponseService
    {
        try {
            $result = $this->categoryRepository->update($categoryDTO);

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @param DTOInterface $categoryDTO
     * @return ResponseService
     */
    public function destroy(DTOInterface $categoryDTO): ResponseService
    {
        try {
            $result = $this->categoryRepository->destroy($categoryDTO);

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }
}
