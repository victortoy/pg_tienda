<?php
require_once '../libs/model.php';

class usuarios extends model{
    protected $tabla = 'usuarios';

    public function login($datos){
    	$datos['password'] = md5($datos['password']);
    	$resultado = parent::select($datos);
    	if(count($resultado['registros']) == 0){
    		return [
    			'ejecuto' => false,
    			'mensajeError' => 'Credenciales erroneas'
    		];
    	}else{
    		$_SESSION['id'] = $resultado['registros'][0]['id'];
    		$_SESSION['nombre'] = $resultado['registros'][0]['nombre'];
    		return [
    			'ejecuto' => true,
    			'registros' => 'Exito'
    		];
    	}
    }

    public function getSesion($datos){
    	return [
    		'ejecuto'=>true,
    		'registros'=>$_SESSION
    	];
    }

    public function destroySesion($datos){
    	session_destroy();
    	return [
    		'ejecuto'=>true,
    		'registros'=>'exito'
    	];
    }
}