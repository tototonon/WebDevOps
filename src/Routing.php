<?php

declare(strict_types=1);


namespace TononT\Webentwicklung;

require_once __DIR__.'/../src/Request.php';
class Routing
{

    protected Request $request;

    function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @param string $requesturi
     */
    public function route(string $requesturi) {

    }
}