<?php
include("conexion.php");
include('modificacionObjeto.php');

$ubicacionModificado = $_POST['ubicacionMueble'];
$colorModificado = $_POST['color'];
$altoModificado = $_POST['alto'];
$largoModificado = $_POST['largo'];
$fondoModificado = $_POST['fondo'];

$modificacion_format_mobiliario = "UPDATE mobiliario SET %s WHERE fk_objeto_mobiliario = $idObjeto";
$modificacion_condiciones_mobiliario = array();

if($ubicacionModificado != "") {
  array_push($modificacion_condiciones_mobiliario, "ubicacion='$ubicacionModificado'");
}
if($colorModificado !=""){
    array_push($modificacion_condiciones_mobiliario, "color='$colorModificado'");
}
if($altoModificado !=""){
    array_push($modificacion_condiciones_mobiliario, "alto='$altoModificado'");
}
if($largoModificado !=""){
    array_push($modificacion_condiciones_mobiliario, "largo='$largoModificado'");
}
if($fondoModificado !=""){
    array_push($modificacion_condiciones_mobiliario, "fondo='$fondoModificado'");
}

if($ubicacionModificado != "" || $colorModificado !="" || $altoModificado !="" || $largoModificado !="" || $fondoModificado !=""){

$modificacion_sql = sprintf($modificacion_format_mobiliario, implode(", ", $modificacion_condiciones_mobiliario));


$resultado = mysqli_query($con, $modificacion_sql); 
}

?>