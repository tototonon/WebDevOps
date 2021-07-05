<?php


namespace TononT\Webentwicklung;


class ForbiddenException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'Forbidden';

    /**
     * @var int
     */
    protected $code = 403;

}