<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Exceptions\MethodNotFound;

require_once __DIR__ . '/../vendor/autoload.php';

const VIEW_PATH = __DIR__ .'/views/';

$router = new App\Router();

$router
    ->get('/home', [HomeController::class, 'index'])
    ->get('/invoice', [InvoiceController::class, 'create'])
    ->post('/invoice', [InvoiceController::class, 'store']);


try {
    echo $router->resolveRoute(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);
} catch (MethodNotFound $e) {
    return var_dump($e->message());
}