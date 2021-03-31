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
        $this->context = $_SERVER;
        $this->params  = $_REQUEST;
        $this->ageRequest();

    }//end __construct()


    public function ageRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get input field value
            $age = htmlspecialchars($_REQUEST['fage']);

            // If input field is empty
            if (empty($age)) {
                // Display message "Age is empty"
                echo 'Age is empty';

                // Else if input field is not empty
            } else {
                // Display age
                echo $age;
            }
        }

    }//end ageRequest()


    public function setContext(): void
    {
        $this->context = $_SERVER['PHP_SELF'];

    }//end setContext()


    public function setRequest(): void
    {
        $this->context = $_REQUEST;

    }//end setRequest()


    public function getContext(): array
    {
            return $this->context;

    }//end getContext()


    public function getRequest(): array
    {
        return $this->params;

    }//end getRequest()


}//end class
