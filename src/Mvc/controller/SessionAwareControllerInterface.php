<?php

declare(strict_types=1);

namespace TononT\Webentwicklung\mvc\controller;


use TononT\Webentwicklung\Http\Session;

interface SessionAwareControllerInterface
{

    /**
     * @return Session
     */
    public function getSession(): Session;

}