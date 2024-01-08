<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller

{
    // public false|string $layout = 'default'; //переопределяем action
    public function indexAction() 
    {   
        $names = ['Jhon', 'Alex', 'Ann'];

        $this->setMeta('Главная страница', 'Descriptions', 'keywords');
        //$this->set(['test' => 'VAR']);
        $this->set(compact('names'));


    }


}