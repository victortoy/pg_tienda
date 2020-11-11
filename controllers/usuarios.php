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
        $sql = "SELECT * 
                FROM usuarios
                WHERE 1 ";
        foreach ($datos as $key => $value) {
            $sql .= "AND $key = '$value'";
        }
        $db = new database();
        return $db->consulta($sql);
    }

    public function update($datos){
        $sql = "UPDATE usuarios SET ";
        foreach ($datos as $key => $value) {
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        $sql .= " WHERE id = ".$datos['id'];
        $db = new database();
        return $db->consulta($sql);
    }

    public function delete($datos){
        $sql = "DELETE FROM usuarios WHERE id = ".$datos['id'];
        $db = new database();
        return $db->consulta($sql);   
    }
}