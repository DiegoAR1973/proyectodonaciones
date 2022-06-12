<?php
include("conexion.php");
$nombreConsutado = $_POST['nombreConsultar'];
$emailConsultado = $_POST['emailConsultar'];
$idUsuarioConsultado = $_POST['id_usuario_Consultar'];

$modificacion_format = "SELECT * FROM personas WHERE %s";
$modificacion_condiciones = array();

if($nombreConsutado != "") {
  array_push($modificacion_condiciones, "nombre='$nombreConsutado'");
}
if($emailConsultado !=""){
    array_push($modificacion_condiciones, "email='$emailConsultado'");
}
if($idUsuarioConsultado  !=""){
    array_push($modificacion_condiciones, "id_persona='$idUsuarioConsultado'");
}



$modificacion_sql = sprintf($modificacion_format, implode(" AND ", $modificacion_condiciones));


$resultado = mysqli_query($con,$modificacion_sql);
$arrayResultados = mysqli_fetch_assoc($resultado); 


echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>