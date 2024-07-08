<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\CategoryDTO;
use App\Domains\Interfaces\DTOInterface;
use App\Domains\Interfaces\Repositories\ICategoryRepository;
use App\Infrastructure\Database\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements ICategoryRepository
{
    private Category $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->category->all();
    }

    /**
     * @param DTOInterface $categoryDTO
     * @return DTOInterface
     */
    public function store(DTOInterface $categoryDTO): DTOInterface
    {
        $model = $this->category->create($categoryDTO->jsonSerialize());

        return CategoryDTO::createFromModel($model);
    }

    /**
     * @param CategoryDTO $categoryDTO
     * @return bool
     */
    public function update(DTOInterface $categoryDTO): bool
    {
        $model = $this->category->findOrFail($categoryDTO->getId()?->getId());

        return $model->update($categoryDTO->jsonSerialize());
    }

    /**
     * @param CategoryDTO $categoryDTO
     * @return bool
     */
    public function destroy(DTOInterface $categoryDTO): bool
    {
        return (bool)$this->category->destroy($categoryDTO->getId()?->getId());
    }
}
