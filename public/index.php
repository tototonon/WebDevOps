<?php

declare(strict_types=1);

use TononT\Webentwicklung\Http\Request;
use TononT\Webentwicklung\Http\Response;
use TononT\Webentwicklung\Router;
use TononT\Webentwicklung\mvc\controller\Blog as BlogController;
use TononT\Webentwicklung\mvc\model\Connection;
use TononT\Webentwicklung\mvc\model\BlogPosts;

require __DIR__ . '/../vendor/autoload.php';


$request = new Request();
$request->setUrl($_SERVER['REQUEST_URI']);
$request->setParameters($_REQUEST);
$response = new Response();
$router = new Router();
$router->addRoute('/blog/show', BlogController::class, 'show');
$router->addRoute('/blog/add', BlogController::class, 'add');
$router->addRoute('/blog/addFile', BlogController::class, 'addFile');



$router->route($request, $response);

http_response_code($response->getStatusCode());
echo $response->getBody();







