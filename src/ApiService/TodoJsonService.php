<?php

declare(strict_types=1);

namespace App\ApiService;

use App\Interface\Service\TodoServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class TodoJsonService
{
    public function __construct(
        private readonly TodoServiceInterface $todoService,
        private readonly SerializerInterface $serializer,
        private readonly LoggerInterface $logger,
        private readonly string $apiUrl,
        private readonly string $apiUser,
        private readonly string $apiSecret,
    ) {
    }

    public function findAllAsJson(): string
    {
        $todoList = $this->todoService->findAll();

        $this->logger->info('ApiUrl: {apiUrl}', ['apiUrl' => $this->apiUrl]);
        $this->logger->info('ApiUser: {apiUser}', ['apiUrl' => $this->apiUser]);
        $this->logger->info('ApiSecret: {apiSecret}', ['apiSecret' => $this->apiSecret]);

        return $this->serializer->serialize($todoList, 'json', ['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,]);
    }
}
