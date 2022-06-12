<?php
include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);

// si se ha chequeado la casilla uniforme
$color = $_POST['color'];
$alto = $_POST['alto'];
$largo = $_POST['largo'];
$fondo = $_POST['fondo'];
$ubicacion = $_POST['ubicacionMueble'];
include('recuperarIdObjeto.php');

echo $ubicacion.'<br/>';
echo $color.'<br/>';
echo $alto.'<br/>';
echo $largo.'<br/>';
echo $fondo.'<br/>';
include('recuperarIdObjeto.php');
$sqlAltaMobiliario = "INSERT INTO mobiliario (ubicacion,color,alto,largo,fondo,fk_objeto_mobiliario)    
                                VALUES ('$ubicacion','$color','$alto','$largo','$fondo','$idObjeto')"; 
mysqli_query($con,$sqlAltaMobiliario);

mysqli_close($con);
?>