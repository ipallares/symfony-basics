<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\TodoRepository;

class TodoService
{
    public function __construct(
        private TodoRepository $todoRepository
    ){
    }

    public function findAll(): array
    {
        return $this->todoRepository->findAll();
    }
}
