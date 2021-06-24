<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;


use TononT\Webentwicklung\Http\IRequest;
use TononT\Webentwicklung\Http\IResponse;

class NotFoundRouter implements IRouter
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     * @return bool
     * @throws NotFoundException
     */
    public function route(IRequest $request, IResponse $response): bool
    {
        throw new NotFoundException();
    }


}