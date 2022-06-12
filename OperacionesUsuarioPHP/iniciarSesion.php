<?php
include("conexion.php");
$emailConsultado = $_POST['emailConsultar'];

$modificacion_format = "SELECT * FROM personas WHERE email = '%s'";

$modificacion_sql = sprintf($modificacion_format, $emailConsultado);

$resultado = mysqli_query($con, $modificacion_sql);
$arrayResultados = mysqli_fetch_assoc($resultado); 

echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>