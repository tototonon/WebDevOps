<?php

declare(strict_types=1);


namespace TononT\Webentwicklung;

use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;
use function call_user_func;


class Routing
{

    /**
     * @var array
     */
    protected array $routes = [];


    /**
     * @param string   $route
     * @param callable $controller
     */
    public function addRoute(string $route, callable $controller)
    {
        $this->routes[$route] = $controller;

    }//end addRoute()


    /**
     * @param IRequest  $request
     * @param IResponse $response
     */
    public function route(IRequest $request, IResponse $response)
    {
        $url = strtolower($request->getUrl());
        foreach ($this->routes as $route => $controller) {
            if (strpos($url, $route) !== false) {
                call_user_func($controller, $request, $response);
                return;
            }
        }

        $response->setBody('Hello there!');

    }//end route()


}//end class
