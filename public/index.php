<?php

declare(strict_types=1);

use TononT\Webentwicklung\AuthenticationRequiredException;
use TononT\Webentwicklung\Http\Request;
use TononT\Webentwicklung\Http\Response;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\Router;
use TononT\Webentwicklung\mvc\controller\Blog as BlogController;
use TononT\Webentwicklung\mvc\controller\Auth as AuthController;
require __DIR__ . '/../vendor/autoload.php';


$request = new Request();


$request->setUrl($_SERVER['REQUEST_URI']);
if(isset($_FILES["file"]["name"])) {
    $request->setFile($_FILES["file"]["name"]);
}
$request->setParameters($_REQUEST);

$response = new Response();
$router = new Router();
$router->addRoute('/auth/login', AuthController::class, 'login');
$router->addRoute('/auth/logout', AuthController::class, 'logout');
$router->addRoute('/blog/show', BlogController::class, 'show');
$router->addRoute('/blog/add', BlogController::class, 'add');

try {
    $router->route($request, $response);
} catch (NotFoundException $exception) {
    // react on content that cannot be found
    $response->setStatusCode($exception->getCode());
    $response->setBody('Sorry, 404');
} catch (AuthenticationRequiredException $exception) {
    // react on missing login
    $response->setStatusCode($exception->getCode());
    $response->setBody('Ein Login wird benötigt');
} catch (\Exception $exception) {
    // react on any exception which we do not catch elsewhere to not expose exception messages
    $response->setStatusCode(500);
    echo $exception;
    $response->setBody('Uh Oh ...');
}


http_response_code($response->getStatusCode());
echo $response->getBody();







