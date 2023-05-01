<?php

namespace App\Interface\Exporter;

interface TodosExporterInterface
{
    public function export(): string;
}
