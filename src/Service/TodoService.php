<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Todo;
use App\Interface\Service\TodoServiceInterface;
use App\Repository\TodoRepository;

class TodoService implements TodoServiceInterface
{
    public function __construct(
        private readonly TodoRepository $todoRepository
    ){
    }

    /**
     * @return Todo[]
     */
    public function findAll(): array
    {
        return $this->todoRepository->findAll();
    }
}
