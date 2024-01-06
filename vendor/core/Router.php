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

    //принимает запрос
    public static function dispatch($url)
    {
       if(self::matchRoute($url)) {
            echo 'OK';
       }else {
        echo 'NO';
       }

    }

    //сравниваем поступившый запрос с шаблоном регулярного выражения
    public static function matchRoute($url):bool
    {
        foreach(self::$routes as $pattern => $route) {

            if(preg_match("~{$pattern}~", $url, $mathes)) {
                foreach($mathes as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                 }

                if(!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                }else {
                    $route['admin_prefix'] = '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']); 
                debug($route);
                return true;
            }
        }
        return false;
    }

    //преобразует action в CamelCase
    protected static function upperCamelCase($str) 
    {
        $str = str_replace('-', '', $str);
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $str;
    }

     //преобразует action в camelCase
     protected static function lowerCamelCase($str) 
     {
        return $str = lcfirst(self::upperCamelCase($str));
     }
}