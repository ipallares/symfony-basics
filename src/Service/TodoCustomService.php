<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Todo;
use App\Interface\Service\TodoServiceInterface;

class TodoCustomService implements TodoServiceInterface
{
    /**
     * @return array<Todo>
     */
    public function findAll(): array
    {
        $todo1 = (new Todo())
            ->setName('Training - with custom Repo')
            ->setDueDate(new \DateTime('+1 day'))
            ->setIsFinished(false)
        ;

        $todo2 = (new Todo())
            ->setName('Italian Course - with custom Repo')
            ->setDueDate(new \DateTime('+1 day'))
            ->setIsFinished(true)
        ;

        return [$todo1, $todo2];
    }
}
