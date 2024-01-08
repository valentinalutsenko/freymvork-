<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller

{
    // public false|string $layout = 'default'; //переопределяем action
    public function indexAction() 
    {   
       $this->layout = 'freymvork-';
    }


}