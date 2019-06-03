<?php


$fileName = basename($_GET['dir']);
/*
solucion 4
resultados: 
no se puede descargar ningun archivo
todos los archivos descargados son corruptos
tamaño de los archivos 0kb

switch(strrchr($fileName, ".")) { 
 case ".gz": $type = "application/x-gzip";  break; 
 case ".tgz": $type = "application/x-gzip"; break; 
 case ".zip": $type = "application/zip"; break; 
 case ".pdf": $type = "application/pdf"; break; 
 case ".png": $type = "image/png"; break; 
 case ".gif": $type = "image/gif"; break; 
 case ".jpg": $type = "image/jpeg"; break; 
 case ".txt": $type = "text/plain"; break; 
 case ".htm": $type = "text/html"; break; 
 case ".html": $type = "text/html"; break; 
 default: $type = "application/octet-stream"; break;} 
 
header("Content-disposition: attachment; filename=".$fileName.";" ); 
header("Content-Type: application/octet-stream");  
header("Content-Type: application/force-download");  
header("Content-Type: application/download"); 
header("Content-Transfer-Encoding: $type\n");  
header("Content-Length: ".filesize($fileName));  
header("Pragma: no-cache");  
header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");  
header("Expires: 0"); 
readfile($_GET['dir']);
*/

/*

solucion 3
resultados: 
no se puede descargar nada
imagenes vacias y archivos corruptos
tamaño de los archivos 0kb

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' .$fileName);
header("Content-Encoding: gzip");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header("Content-Length: " . filesize($fileName));
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
ob_get_clean();
readfile($_GET['dir']);
*/

/*
solucion 2
resultados: 
no se puede descargar ningun archivo
el tamaño de los archivos es el mismo que el de subida 
pero los archivos estan corruptos



$file = file($_GET['id']);

$file2= implode ("",$file);



header("Content-Type:application/octet-stream");
header("Content-Disposition:attachment;filename=".$fileName);

echo $file2;
*/



/*
solucion 1
resultados: 
estable
permite descargar y visualizar los archivos descargados
*/
header("Content-Description: File Transfer");
//header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Disposition:attachment;filename=$fileName");
header("Content-Transfer-Encoding: binary");
//header("Content-Type:application/zip");
readfile($_GET['dir']);



?>