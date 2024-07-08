<?php

namespace App\Application\Services;

class ResponseService
{
    private mixed $data;
    private bool $isSuccess;

    /**
     * @param mixed $data
     * @param bool $isSuccess
     */
    public function __construct(mixed $data, bool $isSuccess = true)
    {
        $this->data = $data;
        $this->isSuccess = $isSuccess;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $result = [
            'success' => $this->isSuccess(),
        ];

        if ($this->isSuccess()) {
            $result['data'] = $this->getData();
        } else {
            $result['errors'] = $this->getData();
        }
        return $result;
    }


}
