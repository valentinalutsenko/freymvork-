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
    //метод работает  с параметрами
    protected static function removeQueryString($url) 
    {
        //explode - Разбивает строку с помощью разделителя
        //str_contains -  Определяет, содержит ли строка заданную подстроку
        if($url) {
            $params = explode("&",  $url, 2);
            if(false === str_contains($params[0], '=')) {
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

    //принимает запрос
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)) {
            $controller = "app\controllers\\" . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller'; 

            if(class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action'] . "Action");

                if(method_exists($controllerObject, $action )) {
                    $controllerObject->$action();
                }else{
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);
                }
            }else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }

        }else {
            throw new \Exception('Страница не найдена', 404);
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
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']); 
                self::$route = $route;

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