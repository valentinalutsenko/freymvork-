<?php

use core\App;

require_once  dirname(__DIR__) . '/config/init.php';

new App();

// var_dump(App::$app->getProperty('pagination'));
// var_dump(App::$app->setProperty('test', 'TEST'));
// var_dump(App::$app->getProperties());

throw new Exception('Oups, Error :(');
