<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Application\DTOs\NewsDTO;
use App\Domains\Interfaces\DTOInterface;
use App\Domains\Interfaces\Repositories\INewsRepository;
use App\Infrastructure\Database\Models\Category;
use App\Infrastructure\Database\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsRepository implements INewsRepository
{
    private News $news;
    private Category $category;

    /**
     * @param News $news
     * @param Category $category
     */
    public function __construct(News $news, Category $category)
    {
        $this->news = $news;
        $this->category = $category;
    }

    /**
     * @param string $term
     * @return Collection
     */
    public function searchByTerm(string $term): Collection
    {
        $newsResult = new Collection();

        $parameter = strtolower($term);

        $categories = $this->category
            ->whereRaw("LOWER(name) LIKE ? ", ["%{$parameter}%"])
            ->with('news')
            ->get();

        foreach ($categories as $category) {
            $newsResult = $newsResult->merge($category->news);
        }

        $news = $this->news
            ->whereRaw("LOWER(title) LIKE ? OR LOWER(summary) LIKE ?  ", ["%{$parameter}%", "%{$parameter}%"])
            ->get();

        $newsResult = $newsResult->merge($news);

        return $newsResult->unique();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->news->all();
    }

    /**
     * @param DTOInterface $newsDTO
     * @return DTOInterface
     */
    public function store(DTOInterface $newsDTO): DTOInterface
    {
        $model = $this->news->create($newsDTO->jsonSerialize());

        return NewsDTO::createFromModel($model);
    }

    /**
     * @param NewsDTO $newsDTO
     * @return bool
     */
    public function update(DTOInterface $newsDTO): bool
    {
        $model = $this->news->findOrFail($newsDTO->getId()?->getId());

        return $model->update($newsDTO->jsonSerialize());
    }

    /**
     * @param NewsDTO $newsDTO
     * @return bool
     */
    public function destroy(DTOInterface $newsDTO): bool
    {
        return (bool)$this->news->destroy($newsDTO->getId()?->getId());
    }
}
