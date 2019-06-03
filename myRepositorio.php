<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repositorio</title>
    <link rel="stylesheet" href="assets/css/gRepositorio.css">
    <link rel="stylesheet" href="assets/css/myRepositorio.css">
</head>
<!-- Codigo generico  1 para cada pagina de repositorio-->
<body id="bg">
<div class="menu">

    <ul>
        <li>EPN-Learning</li>
        <li><a id="menuLocal" href="#">Repositorio</a> </li>
        <li><a href="#">Foro</a> </li>
        <li><a href="#">Contáctanos</a></li>
        <li><a href="#">Ayuda</a> </li>
        <li style="center: right"><a href="conexion/logOut.php">LogOut</a> </li>
    </ul>
</div>
<div class="columna">
    <ul>
        <li><a id="submenuLocal" href="#" >My Repositorio</a></li>
        <li><a href="cargarRepositorio.html" >Cargar Repositorio</a></li>
        <li><a href="#" >Buscar Repositorio</a></li>
    </ul>
</div>

<div class="contenedor">
    <!-- Fin de codigo generico 1 -->
	<form style="display: inline;" action="buscarRep.php" method="post">
   <input type="text" placeholder="Buscar" id="busqueda" style="margin-bottom:10px;" name="buscar">
   <input type="submit" value="Buscar"
   style="
   display:inline;
    background-color: black;
    color:white;
    border: none;
    border-radius: 10px;
    height: 30px;
    width: auto;
    font-size:25px;
    padding-bottom=25px;
    margin-bottom=25px;
    border-bottom=25px;
   ">
	</form>
    <table class="tabla" style="margin-top:10px;">
        <tr>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Autor</th>
            <th>Opciones</th>
        </tr>
		<!-- Estructura php que devuelve los repositorios guardados por el usuario, asi como las opciones de informacion, descargar, borrar y publicar-->
		<?php
		try{
			$conn = new PDO("mysql:host=localhost;dbname=epn","root","");
			//establecer el modo de recolecion de errore en exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql="SELECT idRepositorio,titulo,descripcion,autor, directorio FROM repositorio WHERE idUser='".$_SESSION['userID']."'";
			$resultado=$conn->prepare($sql);
			
			$resultado->execute();
			$filas=$resultado->fetchAll(PDO::FETCH_ASSOC);
			//imprimir en la tabla los resultados
			foreach($filas as $fila){
			//imprimimos en estructura HTML para que se acople a la tabla
			echo "<tr>";
				echo"<th>"; echo $fila['titulo']; echo "</th>";
				echo"<th>"; echo $fila['descripcion']; echo "</th>";
				echo"<th>"; echo $fila['autor']; echo "</th>";
				echo"<th>"; 
				//opciones de visualizar, descargar, borrar e informacion
				echo " <a href='conexion/infoRepositorio.php?id=".$fila['idRepositorio']."'>Informacion</a>,
				<a href='conexion/borrarRep.php?id=".$fila['idRepositorio']."'>Borrar</a>,
				<a href='conexion/descargarRep.php?dir=".$fila['directorio']."'>Descargar</a>"; 
				echo "</th>";
			echo "</tr>";	
			}
			
			
		}catch(Exception $e){
			echo "Error: ".$e->getMessage();
		}
		?>
		<!-- fin de la estructura php-->
    </table>

    <!-- Inicio de codigo generico 2 -->
</div>


<div>
    <footer class="piePagina">
        2019 EPN
    </footer>
</div>
<!-- Fin de codigo generico -->
</body>
</html>