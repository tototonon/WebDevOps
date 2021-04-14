<?php


namespace TononT\Webentwicklung;


use Exception;

require_once __DIR__.'/../src/Http.php';

class Response
{

    protected $body;

    private  $httpstatus;


    public function __construct()
    {
        $this->getBody();
       $this->getHttpstatus();
    }//end __construct()


    /**
     * @return integer
     */
    public function getHttpstatus(): int
    {
        return $this->httpstatus;

    }//end getHttpstatus()


    /**
     * @return string|null
     */
    public function getBody(): string
    {
        return $this->body;

    }//end getBody()


    /**
     * @param string|null $body
     */
    public function setBody(string $body): void
    {
        if ($body != null) {
            $this->body = $body;
        } else {
            throw new Exception('Body is null');
        }

    }//end setBody()


    /**
     * @param integer $httpstatus
     */
    public function setHttpstatus(int $httpstatus): void
    {
        if($httpstatus != 0 && null) {
            $this->httpstatus = Http::send_http_status($httpstatus);

        } else {
            throw new Exception("Http-status-code error");
        }
    }//end setHttpstatus()


}//end class
