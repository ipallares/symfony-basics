<?php

declare(strict_types=1);

namespace App\Exporter;

use App\ApiService\TodoJsonService;
use App\Interface\Exporter\TodosExporterInterface;

class TodosJsonExporter implements TodosExporterInterface
{
    public function __construct(
        private readonly TodoJsonService $todoJsonService
    ) {
    }


    public function export(): string
    {
        $json = $this->todoJsonService->findAllAsJson();

        // Here the actual export would be done. We would need to inject the API client with the proper Api Config to POST the Todos.

        return $json;
    }
}
