<?php
require_once '../libs/model.php';

class empresas extends model{
    protected $tabla = 'empresas';

    public function prueba($datos){
    	$sql = "SELECT COUNT(1) AS cantidad FROM empresas";
    	$db = new database();
    	return $db->consulta($sql);
    }
}