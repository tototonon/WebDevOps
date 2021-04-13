<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;

use Exception;

class Request implements IRequest
{

    // contains the URL of the request
    private static $url;

    // contains the request type of the request : GET | POST
    private static $type = null;

    // contains the segments of the request
    private static $segments = null;

    private static $data = null;

    private static $parameters = null;

    private $httpRequestVar = null;


    public function __construct()
    {
        $this->setHttpRequestMethod();
        $this->setUriProperties();
        $this->setInputData();

    }//end __construct()


    protected function setHttpRequestMethod()
    {
        if (!isset($_SERVER['REQUEST_METHOD'])) {
            return;
        }

        $this->httpRequestVar = $this->validateHttpRequestMethod($_SERVER['REQUEST_METHOD']);

    }//end setHttpRequestMethod()


    protected function validateHttpRequestMethod($input)
    {
        if (empty($input)) {
            throw new Exception('I need valid value');
        }

        switch ($input) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'DELETE':
            case 'HEAD':
            return $input;

            default:
            throw new Exception('Unexpected value.');
        }

    }//end validateHttpRequestMethod()


    public function setUriProperties()
    {
        self::$url = 'http://tonon.test';
        //self::parseURL();

    }//end setUriProperties()


    // set http Action
    protected function setInputData()
    {
        switch ($this->httpRequestVar) {
            case 'GET':
            case 'HEAD':
                $this->setDataFromGet();
            break;

            case 'POST':
                $this->setDataFromPost();
            break;

            case 'PUT':
                $this->setDataFromPut();
            break;

            case 'DELETE':
                // do nothing, no data to set
            break;

            default:
            throw new Exception(
                "Unmapped httpActionMethod. '{$this->httpRequestVar}'"
            );
        }//end switch

    }//end setInputData()


    // TODO
    private function setDataFromGet()
    {

    }//end setDataFromGet()


    private function setDataFromPost()
    {

    }//end setDataFromPost()


    private function setDataFromPut()
    {

    }//end setDataFromPut()


    /*
     * Returns the request type
     */
    public static function getType()
    {
        return self::$type;

    }//end getType()


    /**
     * @return null
     */
    public static function getUrl()
    {
        return self::$url;

    }//end getUrl()


    /**
     * @return null
     */
    public static function getSegments()
    {
        return self::$segments;

    }//end getSegments()


    /**
     * @return null
     */
    public static function getParameters()
    {
        return self::$parameters;

    }//end getParameters()


    /**
     * @return null
     */
    public static function getData()
    {
        return self::$data;

    }//end getData()


    /**
     * @param null $data
     */
    public static function setData($data): void
    {
        self::$data = $data;

    }//end setData()


    public function __toString()
    {
        return 'request example ';

    }//end __toString()


}//end class
