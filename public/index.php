<?php

declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';

try {
    $urlPath = \TononT\Webentwicklung\Request::getUrl();
    if (empty($urlPath)) {
        echo 'path is empty! ';
    }

    if (isset($urlPath)) {
        echo $urlPath;
    }
} catch (Exception $ex) {
    $ex->getMessage();
}
