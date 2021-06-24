<?php

declare(strict_types=1);

use TononT\Webentwicklung\AuthenticationRequiredException;
use TononT\Webentwicklung\Http\Request;
use TononT\Webentwicklung\Http\Response;
use TononT\Webentwicklung\NotFoundException;
use TononT\Webentwicklung\NotFoundRouter;
use TononT\Webentwicklung\RestRouter;
use TononT\Webentwicklung\mvc\controller\Rest\BlogPosts as BlogPostsRestController;
use TononT\Webentwicklung\Router;
use TononT\Webentwicklung\mvc\controller\Blog as BlogController;
use TononT\Webentwicklung\mvc\controller\Auth as AuthController;
use TononT\Webentwicklung\Repository\GetImage as Image;

require __DIR__ . '/../vendor/autoload.php';

$request = new Request();
$request->setUrl($_SERVER['REQUEST_URI']);
$request->setMethod($_SERVER['REQUEST_METHOD']);

if(isset($_FILES["file"]["name"])) {
    $request->setFile($_FILES["file"]["name"]);
    $image = new Image();
    $image->getImage();
}
$request->setParameters($_REQUEST);

$response = new Response();

$routers = [];

$restRouter = new RestRouter();
$routers[] = $restRouter;
$restRouter->addRoute('\/blogposts\/(\S+)', BlogPostsRestController::class, 'getByUrlKey', 'GET');
$restRouter->addRoute('\/blogposts\/getFeed)', BlogPostsRestController::class, 'getFeed', 'GET');

$router = new Router();
$routers[] = $router;
$router->addRoute('/auth/login', AuthController::class, 'login');
$router->addRoute('/home', BlogController::class, 'home');
$router->addRoute('/search', BlogController::class, 'search');
$router->addRoute('/auth/register', AuthController::class, 'register');
$router->addRoute('/auth/logout', AuthController::class, 'logout');
$router->addRoute('/blog/show', BlogController::class, 'show');
$router->addRoute('/blog/add', BlogController::class, 'add');
$router->addRoute('/blog/delete', BlogController::class, 'delete');

$routers[] = new NotFoundRouter();

try {
    // do the actual routing
    foreach ($routers as $router) {
        if ($router->route($request, $response)) {
            break;
        }
    }
} catch (NotFoundException $exception) {
    // react on content that cannot be found
    $response->setStatusCode($exception->getCode());
    $response->redirect("https://tonon.test/home");
    $response->setBody('redirect');
} catch (AuthenticationRequiredException $exception) {
    // react on missing login
    $response->setStatusCode($exception->getCode());
    $response->setBody('Ein Login wird benötigt');
    $response->redirect("https://tonon.test/auth/login");
} catch (\Exception $exception) {
    // react on any exception which we do not catch elsewhere to not expose exception messages
    $response->setStatusCode(500);
    $response->setBody('Uh Oh ...');
}


http_response_code($response->getStatusCode());
echo $response->getBody();







