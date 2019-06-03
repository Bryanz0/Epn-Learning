<?php
require_once('conexion.php');

$conn= new conexion();



$sql="SELECT directorio FROM repositorio WHERE idRepositorio='".$_GET['id']."'";

$resultado=$conn->prepare($sql);

$resultado->execute();

$filas=$resultado->fetchAll(PDO::FETCH_ASSOC);

unlink($filas[0]['directorio']);

echo "archivo borrado exitosamente";
$sql="DELETE FROM repositorio WHERE idRepositorio='".$_GET['id']."'";

$conn->exec($sql);





?>