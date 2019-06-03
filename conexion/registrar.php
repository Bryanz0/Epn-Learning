<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

$cedula=$nombre=$apellido=$username=$tipoUsuario=$correo=$password="";
//variable de identificacion que sirve para saber si se realiza el query de insercion, de haber o no el usuario registrado en la base de datos
$insert=false;


if($_SERVER["REQUEST_METHOD"]=="POST"){
	$cedula=test_input($_POST["cedula"]);
	$nombre=test_input($_POST["nombre"]);
	$apellido=test_input($_POST["apellido"]);
	$username=test_input($_POST["username"]);
	$tipoUsuario=test_input($_POST["usuarios"]);
	$correo=test_input($_POST["correo"]);
	//el password en este caso es de tipo defaut, esto se debe a que al primer inicio de sesion el usuario debe cambiar su contraseña
	$password="1234";	
}

try{
	/*conexion de la vase de datos*/
	$conn = new PDO ("mysql: host=localhost; dbname=epn","root","");
	
	//establecer el modo de recolecion de errore en exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	/*Validacion de registros duplicados*/
	 $sql="Select * from users where cedula='".$cedula."'";
	 
	 $resultado=$conn->prepare($sql);
	 
	 $resultado->execute();
	 if($resultado->rowCount()!=0){
		 echo "usuario duplicado";
		 echo "<br> por favor regrese y verifique que su informacion este correcta";
		 echo "<br> <a href='../register.html'>pagina anterior</a>";
	 }else{
		 $paginaPrincipal="../index.html";
		 echo "usuario registrado exitosamente, le llegara un mensaje a su correo electronico con sus credenciales para ingresar";
		 echo "<br> para regresar a la pagina principal de clic: <br> <a href='$paginaPrincipal'>Pagina principal</a>";
		 $insercion=true;
	 }
	
	if($insercion==true){
	//insercion de los datos en la tabla users
	$sql="INSERT INTO users (cedula,nombre,apellido,tipo,correo,userName,password) VALUES ('".$cedula."', '".$nombre."', '".$apellido."', '".$tipoUsuario."', '".$correo."', '".$username."', '".$password."')";
	//en este caso se utiliza la funcion exec() debido a que la sentencia no tiene retorno
	$conn->exec($sql);
	//Obtenener el el ID del ultimo registro ingresado
	$lastID=$conn->lastInsertId();
	//obtener la fecha 
	$fechaActual=date("d")."/".date("m")."/".date("y");
	//insertar datos en la tabla login
	$sql="INSERT INTO login(idUser,ultimoIngreso,numIngresos) VALUES ('".$lastID."','".$fechaActual."','')";
	$conn->exec($sql);
	//Enviar el correo
	enviarCorreo($correo,$username,$password,$nombre,$apellido);
	}
	
	
	
	
	//**********falta validar las entradas de los datos
	
}catch(Exception $e){
	echo "Error: ".$e->getMessage();
}

function enviarCorreo($correo,$usuario,$contraseña,$nombre,$apellido){
	
//note que este tipo de procedimiento se hace solo cuando se envia un correo desde el localhost
// Instanciacion de las variables para el envio de correo
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output (cambiar a 0)
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;	// Enable SMTP authentication
	//aqui es donde se pondra las credenciales del correo desde donde se enviaran los mensajes
    $mail->Username   = 'epn.learnig@gmail.com';                     // SMTP username
    $mail->Password   = 'Epn-Learnig001';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('epn.learnig@gmail.com', 'Equipo de Epn-Learning');
    $mail->addAddress($correo);     // Add a recipient
   

    // Attachments
	/* enviar archivos
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	*/
	
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Registro exitoso'; 								//Asunto del mensaje
    $mail->Body    = "<h2>HOLA ".$nombre." ".$apellido."</h2> Bienvendido a la plataforma de Epn-Learning, este es el comienzo de una nueva experiencia de aprendizaje.<br>Tus credenciales son:<br>Usuario: ".$usuario."<br>Contraseña: ".$contraseña;

    $mail->send();
    echo 'Mensaje enviado con exito';
} catch (Exception $e) {
    echo "Mensaje no pudo ser enviado Error: {$mail->ErrorInfo}";
}
	
	
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