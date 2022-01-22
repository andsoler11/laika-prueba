<?php

namespace App\Helpers;

interface Response
{
    public function response(int $status, bool $error, $response, ?array $dependencies, ?int $id): array;
}