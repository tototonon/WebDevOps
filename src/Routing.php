<?php

declare(strict_types=1);


namespace TononT\Webentwicklung;

require_once __DIR__.'/../src/Request.php';

use TononT\Webentwicklung\IRequest;
use TononT\Webentwicklung\IResponse;


class Routing
{

    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @param string $route
     * @param callable $controller
     */
    public function addRoute(string $route, callable $controller)
    {
        $this->routes[$route] = $controller;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function route(IRequest $request, IResponse $response)
    {
        $url = strtolower($request->getUrl());
        foreach ($this->routes as $route => $controller) {
            if (strpos($url, $route) !== false) {
                \call_user_func($controller, $request, $response);
                return;
            }
        }

        $response->setBody('Hello there!');
    }
}
