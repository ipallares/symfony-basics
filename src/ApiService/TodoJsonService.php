<?php

declare(strict_types=1);

namespace App\ApiService;

use App\Interface\Service\TodoServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class TodoJsonService
{
    public function __construct(
        private readonly TodoServiceInterface $todoService,
        private readonly SerializerInterface $serializer
    ) {
    }

    public function findAllAsJson(): string
    {
        $todoList = $this->todoService->findAll();

        return $this->serializer->serialize($todoList, 'json', ['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,]);
    }
}
