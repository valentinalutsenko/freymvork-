<?php
namespace core;

abstract class Model
{
    public array $atributes = []; //автозаплнение модели данными
    public array $errors = []; //возможные ошибки, например, при валидации данных
    public array $rules = []; //правила валидации
    public array $labels = []; //указывет, какое поле не прошло валидацию

    public function __construct()
    {
        Db::getInstance(); // получаем обькет подключения с бд
    }

}