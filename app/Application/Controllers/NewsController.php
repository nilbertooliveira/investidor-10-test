<?php

namespace App\Application\Controllers;

use App\Application\DTOs\NewsDTO;
use App\Application\Requests\StoreNewsRequest;
use App\Application\Requests\UpdateNewsRequest;
use App\Domains\Interfaces\Services\ICategoryService;
use App\Domains\Interfaces\Services\INewsService;
use App\Infrastructure\Database\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{

    private INewsService $newsService;
    private ICategoryService $categoryService;

    public function __construct(INewsService $newsService, ICategoryService $categoryService)
    {
        $this->newsService = $newsService;
        $this->categoryService = $categoryService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $response = $this->newsService->list();

        return view('news.index', ['news' => $response->getData()]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = $this->categoryService->list();
        return view('news.create', ['categories' => $categories->getData()]);
    }

    /**
     * @param StoreNewsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $newsDTO = NewsDTO::createFromRequest($request);

        $result = $this->newsService->store($newsDTO);

        if (!$result->isSuccess()) {
            return back()->with('success', false);
        }
        return back()->with('success', true);
    }

    /**
     * @param News $news
     * @return View
     */
    public function show(News $news): View
    {
        return view('news.show', ['news' => $news]);
    }

    /**
     * @param News $news
     * @return View
     */
    public function edit(News $news): View
    {
        $categories = $this->categoryService->list();
        return view('news.edit', ['news' => $news, 'categories' => $categories->getData()]);
    }

    /**
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $request->merge(['id' => $news->id]);

        $newsDTO = NewsDTO::createFromRequest($request);

        $result = $this->newsService->update($newsDTO);

        if (!$result->isSuccess()) {
            return back()->with('success', false);
        }
        return back()->with('success', true);
    }

    /**
     * @param News $news
     * @return RedirectResponse
     */
    public function destroy(News $news): RedirectResponse
    {
        $newsDTO = NewsDTO::createFromModel($news);

        $result = $this->newsService->destroy($newsDTO);

        if (!$result->isSuccess()) {
            return back()->with('success', false);
        }
        return redirect()->route('news.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $result = $this->newsService->searchByTerm($request->input('term'));

        if ($result->isSuccess()) {
            return view('news.index', ['news' => $result->getData()]);
        }
        return view('news.index', ['news' => []]);
    }
}
