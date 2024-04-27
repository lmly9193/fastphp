<?php

use FastRoute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;

$web = require_once '../web.php';

return new class($web)
{
    public Closure $router;
    public string $method;
    public string $uri;

    public function __construct(Closure $router)
    {
        $request = Request::createFromGlobals();
        $this->router = $router;
        $this->method = $request->getMethod();
        $this->uri    = $request->getPathInfo();
    }

    public function run(): void
    {
        $dispatched = (FastRoute\simpleDispatcher($this->router))->dispatch($this->method, $this->uri);
        match ($dispatched[0]) {
            Dispatcher::NOT_FOUND          => $this->onNotFound(),
            Dispatcher::METHOD_NOT_ALLOWED => $this->onNotAllowed($dispatched[1]),
            Dispatcher::FOUND              => $this->onFound($dispatched[1], $dispatched[2]),
            default                        => phpinfo(),
        };
    }

    public function onNotFound(): void
    {
        response('404 Not Found', 404)->send();
    }

    public function onNotAllowed(array $methods): void
    {
        response('405 Method Not Allowed', 405)->send();
    }

    public function onFound(array $callback, array $args): void
    {
        [$controller, $method] = $callback;
        if (!class_exists($controller)) throw new Exception("Controller class $controller not found");
        call_user_func_array([new $controller, $method], $args);
    }
};
