<?php
session_start();
//definir las variables y setearlas en vacio o cero
$username=$contraseña="";
$primerLogin=false;
$existe=false;

//se verifica que el metodo de paso de datos es POST 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$username=test_input($_POST["username"]);
	$contraseña=test_input($_POST["contraseña"]);
	$_SESSION["username"]=$username;
}

// verificar que los datos ingresados esten en la base de datos

try{
	$conn = new PDO("mysql:host=localhost;dbname=epn","root","");
	//establecer el modo de recolecion de errore en exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	//sentencia sql
	$sql="SELECT * FROM users where userName='".$username."' and password='".$contraseña."'";
	
	$resultado=$conn->prepare($sql);
	//asignar el valor a los marcadores
	/*
	$resultado->bindValue(":username",$username);
	$resultado->bindValue(":contraseña",$contraseña);
	*/
	$resultado->execute();
	$numRes=$resultado->rowCount();
	
	if ($numRes!=0){
		//si el usuario existe se verifica si es la primera vez se logea
		
		//recuperar el id del usuario
		$lista=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach ($lista as $listas){
			$idUser=$listas['idusers'];
		}
		
		
		//creamos una variable de sesion que nos servira para tener ese dato para todas las paginas
		$_SESSION["userID"]=$idUser;
		
		$existe=true;
		$sql="select * from login where idUser='".$idUser."' and numIngresos='0'";
		$resultado=$conn->prepare($sql);
		$resultado->execute();
		$numRes=$resultado->rowCount();
		
		//si es la primera vez que se logea
		if ($numRes!=0){
			//se lleva a la pagina para que pueda cambiar su contraseña
			header("location:../changePass.html");
		}
		else{
		//no es la primera vez que se logea, llevar la pagina principal
		header("location:../principal.html");
		}
		
	}else{
		header("location:../login.html");
		
	}
}catch(Exception $e){
	die("Error".$e->getMessage());
}





//funcion que le da seguridad a la pagina, elimina los caracteres especiales para transformarlos en caracteres html
// elimina los / de los datos y los espacios vacios innecesarios
function test_input($data){

$data=trim($data);
$data=stripslashes($data);	
$data=htmlentities($data);

return $data;
}

?>