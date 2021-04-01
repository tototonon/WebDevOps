<?php

declare(strict_types=1);

namespace TononT\Webentwicklung;


class Request implements IRequest
{

    private array $context;

    private array $params;


    /**
     * Construct.
     **/
    public function __construct()
    {
        $this->getContext();
        $this->ageRequest();

    }//end __construct()


    /**
     * Function for request.
     *
     * @return void
     **/
    public function ageRequest(): void
    {
        if (isset($_SERVER)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get input field value
                $age = htmlspecialchars($_REQUEST['fage']);

                // If input field is empty
                if (empty($age)) {
                    echo 'Age is empty';
                } else {
                    // Display age
                    echo $age;
                }
            }
        }

    }//end ageRequest()


    /**
     * Set context.
     *
     * @return void
     **/
    public function setContext(): void
    {
        $this->context = $_SERVER['PHP_SELF'];

    }//end setContext()


    /**
     * Set request.
     *
     * @return void
     **/
    public function setRequest(): void
    {
        $this->context = $_REQUEST;

    }//end setRequest()


    /**
     * Get context.
     *
     * @return array
     **/
    public function getContext(): array
    {
            return $this->context;

    }//end getContext()


    /**
     * Get request.
     *
     * @return array
     **/
    public function getRequest(): array
    {
        return $this->params;

    }//end getRequest()


}//end class
