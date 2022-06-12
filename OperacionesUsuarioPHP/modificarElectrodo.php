<?php
include("conexion.php");
include('modificacionObjeto.php');

$sizenModificado = $_POST['sizeElectrodomestico'];
$claseModificado = $_POST['claseElectrodomestico'];
$altoModificado = $_POST['alto'];
$largoModificado = $_POST['largo'];
$fondoModificado = $_POST['fondo'];
$econsumoModificado = $_POST['tipoElectrodomestico'];
$colorModificado = $_POST['color'];


$modificacion_format_electrodomestico = "UPDATE electrodomesticos SET %s WHERE fk_objeto_elect = $idObjeto";
$modificacion_condiciones_electrodomestico = array();

if($sizenModificado != "") {
  array_push($modificacion_condiciones_electrodomestico, "size='$sizenModificado'");
}
if($altoModificado !=""){
    array_push($modificacion_condiciones_electrodomestico, "alto='$altoModificado'");
}
if($largoModificado !=""){
    array_push($modificacion_condiciones_electrodomestico, "largo='$largoModificado'");
}
if($fondoModificado !=""){
    array_push($modificacion_condiciones_electrodomestico, "fondo='$fondoModificado'");
}
if($econsumoModificado !=""){
    array_push($modificacion_condiciones_electrodomestico, "econsumo='$econsumoModificado'");
}
if($claseModificado !="") {
    array_push($modificacion_condiciones_electrodomestico, "clase='$claseModificado'");
  }
  if($colorModificado != "") {
    array_push($modificacion_condiciones_electrodomestico, "size='$colorModificado'");
  }


if($sizenModificado != "" || $colorModificado !="" || $altoModificado !="" || $largoModificado !="" || $fondoModificado !="" || $econsumoModificado !="" || $claseModificado !=""){

$modificacion_sql = sprintf($modificacion_format_electrodomestico, implode(", ", $modificacion_condiciones_electrodomestico));

echo 'formateado: ' . $modificacion_sql;

$resultado = mysqli_query($con, $modificacion_sql); 
}

?>

