<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require '.maintenance.php';
define('WWW_DIR', __DIR__);
define('APP_DIR', __DIR__ .'/../App');

$container = require __DIR__ . '/../App/bootstrap.php';

$container->getService('application')->run();
