<?php

declare(strict_types=1);

$urlPath = $_SERVER['REQUEST_URI'];
if (strpos(strtolower($urlPath), 'hello')) {
    $personToGreet = 'Stranger';
    if (isset($_REQUEST['name'])) {
        $personToGreet = $_REQUEST['name'];
    }
    echo 'Hello ' . $personToGreet;
} else {
    // example path: /foobar
    echo 'Hello there!';
}
