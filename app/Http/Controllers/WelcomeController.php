<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Helpers\Response;

class WelcomeController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function __invoke()
    {
        return response()->json($this->response->response(200, false, [
            "over" => "LAIKA API APP",
			"home" => "Bienvenido",
            "version" => "1.0.1",
        ], ['current' => ''], null), 200);
    }

}
