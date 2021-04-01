<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;


class Request implements IRequest
{

    // contains the URL of the request
    private static $url = null;

    // contains the request type of the request : GET | POST
    private static $type = null;

    // contains the segments of the request
    private static $segments = null;


    public function __construct()
    {
        $this->setHttpRequestMethod();
        $this->setUriProperties();
        $this->setInputData();

    }//end __construct()


    protected function setHttpRequestMethod()
    {
        $this->httpRequestMethod = $this->validateHttpRequestMethod($_SERVER['REQUEST_METHOD']);

    }//end setHttpRequestMethod()


    protected function validateHttpRequestMethod($input)
    {
        if (empty($input)) {
            throw new InvalidArgumentException('I need valid value');
        }

        switch ($input) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'DELETE':
            case 'HEAD':
            return $input;

                break;
            default:
            throw new InvalidArgumentException('Unexpected value.');
                break;
        }

    }//end validateHttpRequestMethod()


    public function setUriProperties()
    {
        self::parseURL();

    }//end setUriProperties()


    protected function setInputData()
    {
        switch ($this->httpRequestMethod) {
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
                "Unmapped httpActionMethod. '{$this->httpRequestMethod}'"
            );
        }//end switch

    }//end setInputData()


    private static function parseURL()
    {
        $url        = self::$url;
        self::$data = (object) [];
        self::$type = $_SERVER['REQUEST_METHOD'];

        self::$segments = explode('/', $url);

        self::$data->getParameters = array_values(array_diff(array_slice(self::$segments, 2), ['']));

    }//end parseURL()


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

    }

    /**
     * @return null
     */
    public static function getUrl()
    {
        return self::$url;
    }

    /**
     * @return null
     */
    public static function getSegments()
    {
        return self::$segments;
    }//end getType()


}//end class
