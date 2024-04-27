<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    public function index()
    {
        $data = [
            'message' => "Hello, World!",
        ];

        (new JsonResponse($data))->send();
    }

    public function username($username)
    {
        $data = [
            'message' => "Hello, $username!",
        ];

        (new JsonResponse($data))->send();
    }
}
