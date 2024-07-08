<?php

namespace App\Application\Controllers;

use App\Application\DTOs\CategoryDTO;
use App\Application\Requests\StoreCategoryRequest;
use App\Domains\Interfaces\Services\ICategoryService;
use App\Infrastructure\Database\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController
{

    private ICategoryService $categoryService;

    public function __construct(ICategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryService->list();

        return view('categories.index', ['categories' => $categories->getData()]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $categoryDTO = CategoryDTO::createFromRequest($request);

        $result = $this->categoryService->store($categoryDTO);

        if (!$result->isSuccess()) {
            return back()->with('success', false);
        }
        return back()->with('success', true);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('categories.show', ['category' => $category]);
    }

    /**
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $category->refresh();

        return view('categories.edit', ['category' => $category]);
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->merge(['id' => $category->id]);

        $categoryDTO = CategoryDTO::createFromRequest($request);

        $result = $this->categoryService->update($categoryDTO);

        if (!$result->isSuccess()) {
            return back()->with('success', false);
        }
        return back()->with('success', true);
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $categoryDTO = CategoryDTO::createFromModel($category);

        $result = $this->categoryService->destroy($categoryDTO);

        if (!$result->isSuccess()) {
            return back()->with(['success' => false, 'error' => __('ERROR_DELETE')]);
        }
        return back()->with(['success' => true]);
    }
}
