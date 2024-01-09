<?php

namespace core;

use RedBeanPHP\R;

class Db 
{
    use TSingleton;

    private function __construct() 
    {
        $db = require_once CONFIG . '/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['pass']);
        if(!R::testConnection()) {
            throw new \Exception("No connection to DB", 500);
        }

        R::freeze(true); //замораживаем модификацию

        if(DEBUG) {
            R::debug(true, 3); //воз-т sql запросы, которые он выполняет
        }
    }

}