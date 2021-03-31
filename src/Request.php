<?php
declare(strict_types=1);

namespace TononT\Webentwicklung;

// $headers = apache_request_headers();
class Request implements IRequest
{
    /**
     * Construct.
     **/
    public function __construct()
    {
        $this->context    = $_SERVER;
        $this->parameters = $_REQUEST;

    }//end __construct()


    public function getBody()
    {
        // TODO: Implement getBody() method.

    }//end getBody()


}//end class
