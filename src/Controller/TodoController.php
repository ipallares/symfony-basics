<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use App\Service\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo', methods: ['GET'])]
    public function index(TodoService $todoService): Response
    {
        $todoList = $todoService->findAll();

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
            'todoList' => $todoList
        ]);
    }
}
