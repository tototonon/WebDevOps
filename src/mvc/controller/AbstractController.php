<?php


namespace TononT\Webentwicklung\mvc\controller;


use TononT\Webentwicklung\Http\Session;

abstract class AbstractController implements SessionAwareControllerInterface
{

    /**
     * @var Session
     */
    protected Session $session;

    /**
     * AbstractController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

    /**
     * @return Session
     */
    public function getSession(): Session
    {
        return $this->session;
    }


}