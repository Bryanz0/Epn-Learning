<?php


class conexion extends PDO {
	private $servidor="localhost";
	private $nombreBD="epn";
	private $usuario="root";
	private $contraseña="";
	
	public function __construct(){
		//sobreescribir el metodo contructor de la clase PDO
		//para que se ajuste a nuestros parametros
		try{
			parent::__construct("mysql:host={$this->servidor};dbname={$this->nombreBD}",$this->usuario,$this->contraseña);
		}catch(Exception $e){
			echo "Error: ".$e->getMessage();
			exit;
		}
	}
	
	
}

?>