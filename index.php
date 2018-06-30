<?php require_once 'controllers/GiangVien.php';?>
<?php require_once 'config/routes.php';?>
<?php require_once 'config/init.php';?>
<?php
    $route = new Routes();
    $route->Init();
    $action = isset($_GET['action']) ? $_GET['action'] : 'homepage';
    $lecture = new $_GET['controller']();
    $lecture->$action();
?>
