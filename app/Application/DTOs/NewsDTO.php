<?php

namespace App\Application\DTOs;

use App\Domains\Interfaces\DTOInterface;
use App\Domains\ValueObjects\Id;
use App\Infrastructure\Database\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NewsDTO implements DTOInterface
{
    private string $title;
    private string $summary;
    private Id $categoryId;
    private ?Id $id;

    public function __construct(string $title, string $summary, Id $categoryId, ?Id $id = null,)
    {
        $this->title = $title;
        $this->summary = $summary;
        $this->categoryId = $categoryId;
        $this->id = $id;
    }


    /**
     * @return Id|null
     */
    public function getId(): ?Id
    {
        return $this->id;
    }

    /**
     * @param Id|null $id
     * @return NewsDTO
     */
    public function setId(?Id $id): NewsDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return NewsDTO
     */
    public function setTitle(string $title): NewsDTO
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return NewsDTO
     */
    public function setSummary(string $summary): NewsDTO
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return Id
     */
    public function getCategoryId(): Id
    {
        return $this->categoryId;
    }

    /**
     * @param Id $categoryId
     * @return NewsDTO
     */
    public function setCategoryId(Id $categoryId): NewsDTO
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $data = [
            'id' => $this->getId()?->getId(),
            'title' => $this->getTitle(),
            'summary' => $this->getSummary(),
            'category_id' => $this->getCategoryId()->getId()
        ];

        return array_filter($data);
    }

    /**
     * @param News $category
     * @return DTOInterface
     */
    public static function createFromModel(Model $category): DTOInterface
    {
        return new NewsDTO(
            title: $category->title,
            summary: $category->summary,
            categoryId: new Id($category->category_id),
            id: new Id($category->id),
        );
    }

    /**
     * @param Request $request
     * @return DTOInterface
     */
    public static function createFromRequest(Request $request): DTOInterface
    {
        return new NewsDTO(
            title: $request->input('title'),
            summary: $request->input('summary'),
            categoryId: new Id($request->input('category_id')),
            id: $request->has('id') ? new Id($request->input('id')) : null
        );
    }
}
