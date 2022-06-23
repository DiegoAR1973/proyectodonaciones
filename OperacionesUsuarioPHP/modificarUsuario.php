<?php
include("conexion.php");
$nombreModificado = $_POST['nombreModificar'];
$emailModificado = $_POST['emailModificar'];
$paswwordModificado = $_POST['paswordModificar'];
$idUsuario = $_POST['id_usuario_modificar'];

$modificacion_format = "UPDATE personas SET %s WHERE personas.id_persona=$idUsuario";
$modificacion_condiciones = array();

if($nombreModificado != "") {
  array_push($modificacion_condiciones, "nombre='$nombreModificado'");
}
if($emailModificado !=""){
    array_push($modificacion_condiciones, "email='$emailModificado'");
}
if($paswwordModificado  !=""){
    array_push($modificacion_condiciones, "password='$paswwordModificado'");
}


$modificacion_sql = sprintf($modificacion_format, implode(", ", $modificacion_condiciones));


if($nombreModificado != "" || $emailModificado !="" || $paswwordModificado  !=""){
  $resultado = mysqli_query($con, $modificacion_sql); 
}
?>