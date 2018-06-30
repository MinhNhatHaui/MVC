<?php
/**
 * Created by PhpStorm.
 * User: minhnhat
 * Date: 27/06/2018
 * Time: 10:30
 */
require_once 'config/Database.php';
class Model
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(){
        $sql = "SELECT * FROM {$_GET['controller']} ORDER BY id DESC";
        $res = mysqli_query($this->db->link,$sql);
        $data = [];
        if($res){
            while($num = mysqli_fetch_assoc($res)){
                $data[] = $num;
            }
        }
        return $data;
    }

    public function getOne($id) {
        $sql = "SELECT * FROM {$_GET['controller']} WHERE id = {$id}";
        $res = mysqli_query($this->db->link,$sql) or die('Loi truy van getOne theo Id----');
        return mysqli_fetch_assoc($res);
    }

    public function insert( array $data)
    {
        $sql = "INSERT INTO {$_GET['controller']} ";
        $columns = implode(',',array_keys($data));
        $sql .= "( $columns )";
        $values = "";
        foreach($data as $field => $value){
            if(is_string($value)){
                $values .= "'". mysqli_real_escape_string($this->db->link,$value) ."',";
            }else {
                $values .= mysqli_real_escape_string($this->db->link,$values). ',';
            }
        }
        $values = substr($values, 0,-1);
        $sql .= " VALUES (" . $values . ')';
        mysqli_query($this->db->link,$sql) or die("Loi insert----------". mysqli_error($this->db->link));
        return mysqli_insert_id($this->db->link);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$_GET['controller']} WHERE id = {$id}";
        mysqli_query($this->db->link,$sql);
        return mysqli_affected_rows($this->db->link);

    }

    public function xss_clean($data)
        {
            // Fix &entity\n;
            $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
            $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
            $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
            $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

            // Remove any attribute starting with "on" or xmlns
            $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

            // Remove javascript: and vbscript: protocols
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

            // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

            // Remove namespaced elements (we do not need them)
            $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

            do
            {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
            }
            while ($old_data !== $data);

            // we are done...
            return $data;
        }

    public function update( array $data, $id)
    {
        $sql = "UPDATE {$_GET['controller']}";
        $set = " SET ";
        $where = " WHERE id = " .$id;
        foreach($data as $field => $value) {
            if(is_string($value)) {
                $set .= $field .' = '.'\''. mysqli_real_escape_string($this->db->link, $this->xss_clean($value)) .'\', ';
            } else {
                $set .= $field .' = '. mysqli_real_escape_string($this->db->link, $value . ', ');
            }
        }
        $set = substr($set, 0, -2);
        $sql .= $set . $where;
        mysqli_query($this->db->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error($this->db->link));
        return mysqli_affected_rows($this->db->link);
    }




}