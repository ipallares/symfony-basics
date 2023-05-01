<?php

namespace App\Interface\Repository;

use App\Entity\Todo;

interface TodoServiceInterface
{
    /**
     * @return array<Todo>
     */
    public function findAll(): array;
}
