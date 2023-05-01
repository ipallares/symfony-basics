<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\Interface\Service\TodoServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TodoApiController extends AbstractController
{
    #[Route('/api/todo', name: 'app_api_todo', methods: ['GET'])]
    public function index(TodoServiceInterface $todoService): JsonResponse
    {
        $todoList = $todoService->findAll();

        return $this->json($todoList);
    }
}
