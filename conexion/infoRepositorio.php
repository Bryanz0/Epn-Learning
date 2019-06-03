<?php

require_once 'conexion.php';

echo "<h2> Informacion del Repositorio </h2>";
$conn=new conexion();

$sql="SELECT * FROM repositorio WHERE idRepositorio='".$_GET['id']."'";

$resultado=$conn->prepare($sql);

$resultado->execute();
//imprimir la informacion del repositorio seleccionado

$filas=$resultado->fetchAll(PDO::FETCH_ASSOC);

foreach($filas as $fila){
	echo "TITULO: ".$fila['titulo']."<br>";
	echo "DESCRIPCION: ".$fila['descripcion']."<br>";
	echo "TIPO DE ARCHIVO: ".$fila['tipoArchivo']."<br>";
	echo "AUTOR: ".$fila['autor']."<br>";
	echo "INSTITUCION: ".$fila['institucion']."<br>";
	echo "FECHA DE CREACION: ".$fila['fechaCrea']."<br>";
	echo "FECHA DE SUBIDA: ".$fila['fechaSubida']."<br>";
	echo "PALABRAS CLAVE: ".$fila['palabrasClave']."<br>";
	echo "ENLACE (opcional): ".$fila['enlace']."<br>";
}

?>