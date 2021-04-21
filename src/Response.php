<?php


namespace TononT\Webentwicklung;


use Exception;

require_once __DIR__.'/../src/Http.php';

class Response
{

    private  $httpstatus;
    /**
     * @var string
     */
    protected string $body;

    /**
     * @var int
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
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param string $name
     * @return string
     */
    public function getHeader(string $name): string
    {
        return $this->headers[$name];
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @param string $header
     */
    public function setHeader(string $name, string $header): void
    {
        $this->headers[$name] = $header;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name): bool
    {
        return isset($this->headers[$name]);
    }

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
        if($httpstatus != 0 && null) {
            $this->httpstatus = Http::send_http_status($httpstatus);

        } else {
            throw new Exception("Http-status-code error");
        }
    }//end setHttpstatus()


}//end class
