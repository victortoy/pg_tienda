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
            $respuesta['ejecuto'] = false;
            $respuesta['mensajeError'] = $mysqli->connect_error;
        }else{
            $resultado = $mysqli->query($sql);
            if($resultado === TRUE){
                $respuesta['ejecuto'] = true;
            }else if(is_object($resultado)){
                $respuesta['ejecuto'] = true;
                $respuesta['registros'] = [];
                while($fila = $resultado->fetch_assoc()){
                    $respuesta['registros'][] = $fila;
                }
            }else{
                $respuesta['ejecuto'] = false;
                $respuesta['mensajeError'] = $mysqli->error;
            }
        }
        return $respuesta;
    }
}