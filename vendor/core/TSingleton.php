<?php
namespace core;

trait TSingleton {
    private static ?self $instance = null;

    private function __construct () { }

//для получения экземпляра класса
    public static function getInstance():static
    {
        return static::$instance ?? static::$instance = new static();
    }


}