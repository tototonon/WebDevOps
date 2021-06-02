<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;

use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;

class Router implements IRouter
{

    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @param string $route
     * @param string $controllerName
     * @param string $actionName
     */

    public function addRoute(string $route, string $controllerName, string $actionName)
    {
        $this->routes[$route] = [
            'controller' => $controllerName,
            'action' => $actionName
        ];

    }//end addRoute()


    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return bool
     */
    public function route(IRequest $request, IResponse $response) :bool
    {
        $url = strtolower($request->getUrl());
        foreach ($this->routes as $route => $controllerArray) {
            if (strpos($url, $route) !== false) {
                $controller = new $controllerArray['controller']();
                $action = $controllerArray['action'];
                $controller->$action($request, $response);
                return true;
            }


        }

        return false;


    }//end class
}
