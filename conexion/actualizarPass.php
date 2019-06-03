<?php
session_start();
//declaracion de variables
$contraseña1=$contraseña2="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
		$contraseña1=test_input($_POST["contraseña1"]);
		$contraseña2=test_input($_POST["contraseña2"]);	
	//el password en este caso es de tipo defaut, esto se debe a que al primer inicio de sesion el usuario debe cambiar su contraseña
	$password="1234";	
}

if(verificarPassword($contraseña1,$contraseña2)){
	try{
	/*conexion de la vase de datos*/
	$conn = new PDO ("mysql: host=localhost; dbname=epn","root","");
	
	//establecer el modo de recolecion de errore en exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="UPDATE users SET password='".$contraseña1."' WHERE idusers = '".$_SESSION['userID']."'";
	
	if($conn->exec($sql)){
		echo "<h2> Contraseña actualizada correctamente </h2>";
	echo "Por favor dirigete a la pantalla principal e ingresa nuevamente para que puedas usar la plataforma<br>";
	echo "<a href='../index.html'> pagina principal</a>";
	//ya que el usuario ya ha cambiado su contraseña, ahora se debe cambiar el numero de ingresos a la plataforma
	$sql="UPDATE login SET numIngresos='1' WHERE idUser = '".$_SESSION['userID']."'";
	$conn->exec($sql);
	
	}else{
		echo"error: ". $conn->error;
	}
	
	
	} catch(Exception $e){
		echo "Error: ".$e->getMessage();
	}
}else{
	echo "<h2> Upss!!! </h2>";
	echo "las contraseñas no coinciden, por favor regresa a la pagina anterior e ingresa de nuevo tu nueva contraseña<br>";
	echo "<a href='../changePass.html'>regresar</a>";
}


//verificar que las contraseñas esten correctas
function verificarPassword($p1, $p2){
	if ($p1===$p2){
		return true;
	}else{
		return false;
	}
	
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