<?php

declare(strict_types=1);

use TononT\Webentwicklung\Request;
use TononT\Webentwicklung\Http;
use TononT\Webentwicklung\Response;

require_once __DIR__ . '/../src/Http.php';
require __DIR__ . '/../vendor/autoload.php';


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $request = new Request();
    $urlPath = 'http://tonon.test';
    if (empty($urlPath) === true) {
        echo 'path is empty! ';
        Http::send_http_status(400);
        exit(1);
    }

    if (isset($request) === true) {
        echo $request;
    } else {
        if ($request !== null) {
            echo 'The path is: ';
            echo $urlPath;
            echo 'The request is: ';
            echo $request;
        }
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
}

