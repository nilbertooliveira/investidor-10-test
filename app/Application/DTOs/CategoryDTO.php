<?php

namespace App\Application\DTOs;

use App\Domains\Interfaces\DTOInterface;
use App\Domains\ValueObjects\Id;
use App\Infrastructure\Database\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryDTO implements DTOInterface
{
    private string $name;
    private string $description;
    private ?Id $id;

    public function __construct(string $name, string $description, ?Id $id = null,)
    {
        $this->name = $name;
        $this->description = $description;
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
     * @return CategoryDTO
     */
    public function setId(?Id $id): CategoryDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CategoryDTO
     */
    public function setName(string $name): CategoryDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return CategoryDTO
     */
    public function setDescription(string $description): CategoryDTO
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $data = [
            'id' => $this->getId()?->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
        ];

        return array_filter($data);
    }

    /**
     * @param Category $category
     * @return DTOInterface
     */
    public static function createFromModel(Model $category): DTOInterface
    {
        return new CategoryDTO(
            name: $category->name,
            description: $category->description,
            id: new Id($category->id)
        );
    }

    /**
     * @param Request $request
     * @return DTOInterface
     */
    public static function createFromRequest(Request $request): DTOInterface
    {
        return new CategoryDTO(
            name: $request->input('name'),
            description: $request->input('description'),
            id: $request->has('id') ? new Id($request->input('id')) : null
        );
    }
}
