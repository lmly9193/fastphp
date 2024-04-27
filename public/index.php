<?php

$root = str_replace('\\', '/', dirname(__DIR__));

// Register the Composer autoloader...
require_once $root . '/vendor/autoload.php';

// Bootstrap the application...
$app = require_once $root . '/bootstrap/app.php';

// Run the application...
$app->run();
