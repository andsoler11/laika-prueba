<?php

namespace App\Helpers;
use App\Helpers\Response;

final class JsonResponse implements Response
{

    private $responseStrcuture;
    private $api;

    public function __construct()
    {
        $this->responseStrcuture = [];
        $this->api = $_ENV['API_ROUTE'];
    }

    public function response(int $status, bool $error,  $response, ?array $dependencies, ?int $id): array
    {
        return $this->responseStrcuture = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $response,
            "current_url" => $this->api . $dependencies['current'] . $id
        ];
    }
}