<?php
session_start();



//eliminar todas las variables de sesion
session_unset();
// destruir la sesion
session_destroy();

header("location:../index.html");


?>