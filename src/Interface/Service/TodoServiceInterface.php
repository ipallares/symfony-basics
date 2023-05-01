<?php

namespace App\Interface\Service;

use App\Entity\Todo;

interface TodoServiceInterface
{
    /**
     * @return array<Todo>
     */
    public function findAll(): array;
}
