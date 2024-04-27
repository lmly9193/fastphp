<?php

return function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [\App\Controllers\HomeController::class, 'index']);
    $r->addRoute('GET', '/{username}', [\App\Controllers\HomeController::class, 'username']);
};
