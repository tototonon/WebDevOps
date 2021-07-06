<?php

namespace TononT\Webentwicklung;

use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;
use TononT\Webentwicklung\Http\RestRequest;

class RestRouter implements IRouter
{
    public const REST_ENDPOINT_IDENTIFIER = 'rest';

    protected array $routes = [];

    /**
     * @param string $route
     * @param string $controllerName
     * @param string $actionName
     * @param $method
     */
    public function addRoute(string $route, string $controllerName, string $actionName, $method)
    {
        $this->routes[$route][$method] = [
            'controller' => $controllerName,
            'action' => $actionName,
        ];
    }

    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return bool
     */
    public function route(IRequest $request, IResponse $response): bool
    {
        $url = strtolower($request->getUrl());
        // check for our initial identifier
        if (strpos($url, static::REST_ENDPOINT_IDENTIFIER) === false) {
            return false;
        }

        // create our REST request instance
        $request = RestRequest::fromRequestInstance($request);

        foreach ($this->routes as $route => $methodArray) {
            $pattern = '/^\/' . static::REST_ENDPOINT_IDENTIFIER . $route . '/';
            $matches = [];
            if (preg_match($pattern, $url, $matches)) {
                unset($matches[0]);
                $request->setIdentifiers($matches);
                foreach ($methodArray as $method => $controllerArray) {
                    if (strtolower($method) === strtolower($request->getMethod())) {
                        $controller = new $controllerArray['controller']();
                        $action = $controllerArray['action'];
                        $controller->$action($request, $response);
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
