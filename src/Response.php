<?php


namespace TononT\Webentwicklung;


use Exception;

require_once __DIR__.'/../src/Http.php';

class Response
{

    private $httpstatus;

    /**
     * @var string
     */
   protected string $body;

    /**
     * @var integer
     */
    protected int $statusCode = 200;

    /**
     * @var array
     */
    protected array $headers;


    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;

    }//end getBody()


    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;

    }//end setBody()


    /**
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;

    }//end getStatusCode()


    /**
     * @param integer $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;

    }//end setStatusCode()


    /**
     * @param  string $name
     * @return string
     */
    public function getHeader(string $name): string
    {
        return $this->headers[$name];

    }//end getHeader()


    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;

    }//end getHeaders()


    /**
     * @param string $name
     * @param string $header
     */
    public function setHeader(string $name, string $header): void
    {
        $this->headers[$name] = $header;

    }//end setHeader()


    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;

    }//end setHeaders()


    /**
     * @param  string $name
     * @return boolean
     */
    public function hasHeader(string $name): bool
    {
        return isset($this->headers[$name]);

    }//end hasHeader()


    /**
     * @return integer
     */
    public function getHttpstatus(): int
    {
        return $this->httpstatus;

    }//end getHttpstatus()


    /**
     * @param integer $httpstatus
     */
    public function setHttpstatus(int $httpstatus): void
    {
        if ($httpstatus != 0 && null) {
            $this->httpstatus = Http::send_http_status($httpstatus);
        } else {
            throw new Exception('Http-status-code error');
        }

    }//end setHttpstatus()


}//end class
