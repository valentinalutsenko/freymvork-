<?php
namespace core;

class Registry
 {
    use TSingleton;

    //контейнер, в который будут заптсываться данные
    protected static array $propertise = [];


    //Записывает данные в контейнер
    public function setProperty($name, $value) 
    {
        self::$propertise[$name] = $value;
    }

    //Получает данные из контейнера
    public function getProperty($name) 
    {
       return self::$propertise[$name] ?? null;
    }

    //Возвращает массив всех данных в контейнере
    public function getProperties():array 
    {
        return self::$propertise;
    }
}