<?php

namespace App\Application\Services;

use App\Domains\Interfaces\DTOInterface;
use App\Domains\Interfaces\Repositories\INewsRepository;
use App\Domains\Interfaces\Services\INewsService;

class NewsService implements INewsService
{
    private INewsRepository $newsRepository;

    /**
     * @param INewsRepository $newsRepository
     */
    public function __construct(INewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * @param string $term
     * @return ResponseService
     */
    public function searchByTerm(string $term): ResponseService
    {
        try {
            $news = $this->newsRepository->searchByTerm($term);

            $result = new ResponseService($news);
        } catch (\Throwable $e) {
            $result = new ResponseService($e->getMessage(), false);
        }
        return $result;
    }

    /**
     * @return ResponseService
     */
    public function list(): ResponseService
    {
        try {
            $news = $this->newsRepository->list();

            $result = new ResponseService($news->getIterator()->getArrayCopy());
        } catch (\Throwable $e) {
            $result = new ResponseService($e->getMessage(), false);
        }
        return $result;
    }

    /**
     * @param DTOInterface $newsDTO
     * @return ResponseService
     */
    public function store(DTOInterface $newsDTO): ResponseService
    {
        try {
            $result = $this->newsRepository->store($newsDTO);

            return new ResponseService($result->jsonSerialize());
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @param DTOInterface $newsDTO
     * @return ResponseService
     */
    public function update(DTOInterface $newsDTO): ResponseService
    {
        try {
            $result = $this->newsRepository->update($newsDTO);

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }

    /**
     * @param DTOInterface $newsDTO
     * @return ResponseService
     */
    public function destroy(DTOInterface $newsDTO): ResponseService
    {
        try {
            $result = $this->newsRepository->destroy($newsDTO);

            return new ResponseService($result);
        } catch (\Throwable $e) {
            return new ResponseService($e->getMessage(), false);
        }
    }
}
