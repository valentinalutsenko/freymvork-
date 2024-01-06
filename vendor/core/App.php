<?php

namespace core;

class App 
{
    public static $app;

    public function __construct() 
    {   
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/'); //получаем текущий адрес

        
        new ErrorHandler();        
        self::$app = Registry::getInstance(); //получаем экземпляр класса
        $this->getParams();
        Router::dispatch($query);

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