<?php
require_once '../libs/database.php';

class usuarios{
    public function insert($datos){
        $sql = "INSERT INTO usuarios SET ";
        foreach($datos as $key => $value){
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        $db = new database();
        return $db->consulta($sql);
    }

    public function select($datos){
        $sql = "SELECT * FROM usuarios";
        $db = new database();
        return $db->consulta($sql);
    }
}