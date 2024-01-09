<?php
namespace app\models;

use RedBeanPHP\R;
use \core\Model;


class Main extends Model
{
    public function get_names(): array
    {
        return R::findAll('name');
    }
}