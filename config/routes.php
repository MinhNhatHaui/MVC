<?php
/**
 * Created by PhpStorm.
 * User: minhnhat
 * Date: 27/06/2018
 * Time: 11:38
 */


class Routes
{
    public function __construct()
    {
        global $view_path, $model_path, $controller_path;
        $this->view_path = $view_path;
        $this->model_path = $model_path;
        $this->controller_path= $controller_path;
        $this->controller = $_GET['controller'];

    }

    public function Init()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'homepage';
        $controller = $_GET['controller'];
        if($controller != "")
        {
            require_once ("$this->controller_path/$this->controller.php");
            $c = new $controller;
            $c->$action();
        }
    }

}