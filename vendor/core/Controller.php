<?php
namespace core;


abstract class Controller 
{
    public array $data = [];
    public array $meta = [];
    public false|string $layout = '';
    public string $view = '';
    public object $model;


    public function __construct(public $route= [])
    {
        
    }


    public function getModel() 
    {
        $model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];
        
        if(class_exists($model)) {
            $this->model = new $model();
        }

    }

    //метод определяет  нужный вид и подключает шаблон
    public function getView() 
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);

    }

   
    public function set($data) 
    {
        $this->data = $data;
        

    }

     //устанавливает мета данные
    public function setMeta($title = '', $description = '', $keywords = '') 
    {
        $this->meta = [
            'title' => $title, 
            'description' => $description, 
            'keywords' => $keywords
        ];

    }

} 