<?php

use Symfony\Component\HttpFoundation\Response;

if (!function_exists('response')) {
    function response(?string $content = '', int $status = 200, array $headers = [])
    {
        return new Response($content, $status, $headers);
    }
}
