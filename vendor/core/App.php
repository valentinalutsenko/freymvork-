<?php

namespace core;

class App 
{
    public static $app;

    public function __construct() 
    {               
        self::$app = Registry::getInstance(); //получаем экземпляр класса
        $this->getParams();
    }


    //Записываем парраметры в контейнер $instance трейта TSingleton
    protected function getParams () 
    {
        
        $params = require_once CONFIG . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }         
    }
}