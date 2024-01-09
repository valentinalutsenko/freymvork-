<?php

namespace app\controllers;

use RedBeanPHP\R;
use app\models\Main;
use core\Controller;

/**
 *  @property Main $model
 */

class MainController extends Controller

{
    // public false|string $layout = 'default'; //переопределяем action
    public function indexAction() 
    {   
        // $names = ['Jhon', 'Alex', 'Ann'];
        // $names = $this->model->get_names();
        $names = R::findAll('name');
        R::getRow('SELECT * FROM name WHERE id = 2');


        // debug($names);
        $this->setMeta('Главная страница', 'Descriptions', 'keywords');
        //$this->set(['test' => 'VAR']);
        $this->set(compact('names'));
        


    }


}