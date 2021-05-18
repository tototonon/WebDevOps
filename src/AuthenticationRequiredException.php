<?php


class AuthenticationRequiredException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Aktiver Login benötigt';

    /**
     * @var int
     */
    protected $code = 401;


}