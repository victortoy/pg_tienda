<?php
class database{
    private $HOST = 'localhost';
    private $DB = 'tienda';
    private $USER = 'root';
    private $PASS = '';

    public function select($tabla, $datos){
        $sql = "SELECT * 
                FROM $tabla
                WHERE 1 ";
        foreach ($datos as $key => $value) {
            $sql .= "AND $key = '$value'";
        }
        return $this->consulta($sql);
    }

    public function insert($tabla, $datos){
        $sql = "INSERT INTO $tabla SET ";
        foreach($datos as $key => $value){
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        return $this->consulta($sql);
    }    

    public function update($tabla, $datos){
        $sql = "UPDATE $tabla SET ";
        foreach ($datos as $key => $value) {
            $sql .= "$key = '$value',";
        }
        $sql = rtrim($sql,',');
        $sql .= " WHERE id = ".$datos['id'];
        return $this->consulta($sql);
    }

    public function delete($tabla, $datos){
        $sql = "DELETE FROM empresas WHERE id = ".$datos['id'];
        return $this->consulta($sql);
    }

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
                $respuesta['ultimo_insertado'] = $mysqli->insert_id;
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