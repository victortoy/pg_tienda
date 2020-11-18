<?php
require_once '../libs/model.php';

class empresas{
    public function insert($datos){
        $sql = "INSERT INTO empresas SET ";
        foreach($datos as $key => $value){
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        $db = new database();
        return $db->consulta($sql);
    }

    public function select($datos){
        $sql = "SELECT * 
                FROM empresas
                WHERE 1 ";
        foreach ($datos as $key => $value) {
            $sql .= "AND $key = '$value'";
        }
        $db = new database();
        return $db->consulta($sql);
    }

    public function update($datos){
        $sql = "UPDATE empresas SET ";
        foreach ($datos as $key => $value) {
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        $sql .= " WHERE id = ".$datos['id'];
        $db = new database();
        return $db->consulta($sql);
    }

    public function delete($datos){
        $sql = "DELETE FROM empresas WHERE id = ".$datos['id'];
        $db = new database();
        return $db->consulta($sql);   
    	$sql = "SELECT COUNT(1) AS cantidad FROM empresas";
    	$db = new database();
    	return $db->consulta($sql);
    }
}