<?php
class database{
    private $HOST = 'localhost';
    private $DB = 'tienda';
    private $USER = 'root';
    private $PASS = '';

    public function consulta($sql){
        $respuesta = [];
        $mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DB);
        if($mysqli->connect_errno){
            echo "Presento el siguiente error: ".$mysqli->connect_error;
            exit;
        }
        $resultado = $mysqli->query($sql);
        if($resultado == TRUE){
            $respuesta['ejecuto'] = true;
        }else{
            $respuesta['ejecuto'] = false;
            $respuesta['mensajeError'] = $mysqli->error;
        }
        return $respuesta;        
    }
}