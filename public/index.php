<?php

declare(strict_types=1);

use TononT\Webentwicklung\Request;
use TononT\Webentwicklung\Http;
use TononT\Webentwicklung\Response;

require_once __DIR__ . '/../src/Http.php';
require __DIR__ . '/../vendor/autoload.php';


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$request = new Request();
$request->setUrl($_SERVER['REQUEST_URI']);
$request->setParameters($_REQUEST);

$response = new Response();

$router = new Router();

$router->addRoute('/blog/show', [BlogController::class, 'show']);
$router->route($request, $response);

http_response_code($response->getStatusCode());
echo $response->getBody();
