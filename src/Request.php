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
        $this->idRequest();
        $this->getRequest();

    }//end __construct()


    /**
     * Function for request.
     *
     * @return void
     **/
    public function idRequest(): void
    {
        if (isset($_REQUEST['id']) && isset($_REQUEST['user'])) {
            $id = $_REQUEST['id'];

            $user = $_REQUEST['user'];

            echo 'Welcome '.$user.' - ID: '.$id;
        } else {
            echo 'Welcome visitor';
        }

    }//end idRequest()


    /**
     * Function for Postrequest.
     *
     * @return void
     **/
    public function postRequest()
    {
        if (isset($_POST['user'])) {
            echo 'Welcome '.$_POST['user'];
        } else {
            echo 'Welcome visitor';
        }

    }//end postRequest()


    /**
     * Function for Getrequest.
     *
     * @return array
     **/
    public function getRequest(): array
    {
        if (isset($_GET['src']) && isset($_GET['id'])) {
            return;
        } else {
            // other php instructions
        }

    }//end GETRequest()


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
     * Get context.
     *
     * @return array
     **/
    public function getContext(): array
    {
            return $this->context;

    }//end getContext()


}//end class
