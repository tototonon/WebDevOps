<?php

declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

try {
    $urlPath = \TononT\Webentwicklung\Request::getUrl();
    if (strpos(strtolower($urlPath), 'hello')) {
        $personToGreet = 'Stranger';
        if (isset($_REQUEST['name'])) {
            $personToGreet = $_REQUEST['name'];
        }

        echo 'Hello '.$personToGreet;
    } else {
        echo 'Hello there!';
    }
} catch (Exception $ex) {
    $ex->getMessage();
}
