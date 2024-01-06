<?php
namespace core;

class Router 
{
    protected static array $routes = []; //содержиться таблица маршрутов
    protected static array $route = []; // записывается один конктретный маршрут из $routes[]


    //добавляем данные в таблицу $routes
    public static function add($regexp, $route = [])
    {
       self::$routes[$regexp] = $route;

    }

    
    public static function getRoutes():array
    {
       return self::$routes;

    }

    
    public static function getRoute()
    {
       return self::$route;

    }

    //
    public static function dispatch($url)
    {
       var_dump($url);

    }


}