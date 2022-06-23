<?php
include("conexion.php");
include('modificacionObjeto.php');

$edadModificado = $_POST['edad'];
$generoModificado = $_POST['genero'];
$tallaModificado = $_POST['talla'];




$modificacion_format_ropa = "UPDATE ropa SET %s WHERE fk_objeto_ropa = $idObjeto";
$modificacion_condiciones_zapato = array();

if($generoModificado != "") {
  array_push($modificacion_condiciones_ropa, "genero='$generoModificado'");
}
if($edadModificado !=""){
    array_push($modificacion_condiciones_ropa, "tipo='$edadModificado'");
}



$modificacion_sql = sprintf($modificacion_format_ropa, implode(", ", $modificacion_condiciones_ropa));


if($generoModificado != "" || $edadModificado !=""){
    $resultado = mysqli_query($con, $modificacion_sql); 
}


?>