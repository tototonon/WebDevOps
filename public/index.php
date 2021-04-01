<?php

declare(strict_types=1);

$urlPath = $_SERVER['REQUEST_URI'];
try {
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
