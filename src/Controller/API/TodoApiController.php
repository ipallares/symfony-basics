<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\ApiService\TodoJsonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoApiController extends AbstractController
{
    #[Route('/api/todo', name: 'app_api_todo', methods: ['GET'])]
    public function index(TodoJsonService $todoJsonService): Response
    {
        $todoList = $todoJsonService->findAllAsJson();

        return new JsonResponse(data: $todoList, json: true);
    }
}
