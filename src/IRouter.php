<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;


use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;

interface IRouter
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return bool
     */
    public function route(IRequest$request, IResponse $response): bool;


}