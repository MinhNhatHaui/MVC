<?php
require_once 'models/Model.php';
class Controller
{

    public function view($viewname, $data = null, $uselayout = true)
    {
        global $view_path, $model_path, $controller_path;
        $controller_name = get_class($this);
        if($uselayout)
        {
            require_once("layout/header.php");
        }
        /*if($data != null){
            foreach ($data as $key => $value)
            {
                $$key = $value;
            }
        }*/

        require_once("$view_path/$controller_name/$viewname.php");

        if($uselayout)
        {
            require_once('layout/footer.php');
        }
    }



}