<?php
//iniciamos la sesion que contiene los datos del usuario
session_start();

print_r($_FILES);
//declaracion de las variables de repositorio
$titulo=$descripcion=$tipoArchivo=$autor=$institucion=$fechaCrea=$fechaSubida=$palabrasClave=$enlace=$carrera=$materia="";
//archivo
$nombreArchivo=$pesoArchivo=$directorioArchivo=$tipoArchivo="";


//se verifica que el metodo de paso de datos es POST 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$titulo=test_input($_POST['titulo']);
	$descripcion=test_input($_POST['desc']);
	$tipoArchivo=test_input($_POST['tipoArchivo']);
	$autor=test_input($_POST['autor']);
	$institucion=test_input($_POST['inst']);
	$fechaCrea=test_input($_POST['fechaCrea']);
	$fechaSubida=date("d")."-".date("m")."-".date("y");
	$palabrasClave=test_input($_POST['palabrasClave']);
	$enlace=test_input($_POST['link']);
	$carrera=$_POST['carrera'];
	$materia=$_POST['materia'];
	//variables del archivo subido
	$nombreArchivo=$_FILES['archivo']['name'];
	$pesoArchivo=$_FILES['archivo']['size'];
	$directorioArchivo=$_SERVER['DOCUMENT_ROOT']."/Epn-Learning/repositorio/";
	$tipoArchivo=$_FILES['archivo']['type'];
}




//importante: el nombre del archivo es guardado mas el id del usuario
//esto es para que cuando un usuario inserte un archivo se facil destingurlo
try{
	$conn = new PDO("mysql:host=localhost;dbname=epn","root","");
	//establecer el modo de recolecion de errore en exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//sentencia sql
	$sql="INSERT INTO repositorio (titulo, descripcion, tipoArchivo,autor,institucion,fechaCrea,fechaSubida, palabrasClave,enlace, carrera, materia, directorio, idUser) VALUES ('".$titulo."', '".$descripcion."', '".$tipoArchivo."', '".$autor."', '".$institucion."', '".$fechaCrea."', '".$fechaSubida."', '".$palabrasClave."', '".$enlace."', '".$carrera."', '".$materia."', '".$directorioArchivo.$_FILES['archivo']['name']."', '".$_SESSION['userID']."')";
	
	$conn->exec($sql);
	echo "<br> repositorio subido exitosamente";
	
	moverArchivo($_FILES['archivo']['tmp_name'],$directorioArchivo.$_FILES['archivo']['name']);
	
}catch(Exception $e){
	echo "error: ".$e->getMessage();
}



//funcion para mover el archivo del directorio temporal al directorio de archivos del sistema
function moverArchivo($rutaTemp,$rutaFinal) {
move_uploaded_file($rutaTemp,$rutaFinal);	
}

// *********************generico*************
//funcion que le da seguridad a la pagina, elimina los caracteres especiales para transformarlos en caracteres html
// elimina los / de los datos y los espacios vacios innecesarios
function test_input($data){

$data=trim($data);
$data=stripslashes($data);	
$data=htmlentities($data);

return $data;
}



?>