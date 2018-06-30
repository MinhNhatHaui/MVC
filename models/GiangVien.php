<?php
/**
 * Created by PhpStorm.
 * User: minhnhat
 * Date: 27/06/2018
 * Time: 11:09
 */
class GiangVienModel extends Model
{
    public function checkId($query){
        $sql = "SELECT * FROM {$_GET['controller']} WHERE ";
        $sql .= $query;
        $result = mysqli_query($this->db->link,$sql);
        return mysqli_fetch_assoc($result);
    }
}
