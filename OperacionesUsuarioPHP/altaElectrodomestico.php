<?php
include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);
$size = $_POST['sizeElectrodomestico'];
$clase = $_POST['claseElectrodomestico'];
$eConsumo = $_POST['tipoElectrodomestico'];
$alto = $_POST['alto'];
$largo = $_POST['largo'];
$fondo = $_POST['fondo'];
echo $eConsumo;
   
include('recuperarIdObjeto.php');
$sqlAltaElectrodomestico = "INSERT INTO electrodomesticos (size,alto,largo,fondo,econsumo,clase,fk_objeto_elect)    
                                VALUES ('$size','$alto ','$largo','$fondo','$eConsumo','$clase','$idObjeto')"; 
mysqli_query($con,$sqlAltaElectrodomestico);
?>