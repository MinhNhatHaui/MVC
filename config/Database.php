<?php
/**
 * Created by PhpStorm.
 * User: minhnhat
 * Date: 27/06/2018
 * Time: 15:39
 */
class Database
{
    public $link;

    public function __construct()
    {
        global $host,$user,$password,$database;
        $this->link = mysqli_connect($host,$user,$password,$database);
        mysqli_set_charset($this->link,'utf8');
    }
}
