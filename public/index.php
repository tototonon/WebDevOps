<?php

declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';
//TODO

try {
    $request = new \TononT\Webentwicklung\Request(); //?
    $urlPath = "http://tonon.test";
    if (empty($urlPath)) {
        echo 'path is empty! ';
    }

    if (isset($request)) {
        echo $request;
    } else {
        if(isset($urlPath)&&$request != null){
            echo "The path is: ";
            echo $urlPath;
            echo "The request is: ";
            echo $request;
        }
    }
} catch (Exception $ex) {
    $ex->getMessage();
}
