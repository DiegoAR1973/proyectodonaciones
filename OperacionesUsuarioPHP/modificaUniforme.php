<?php
include("conexion.php");

$generoUniformeModificado = $_POST['generoUniforme'];
$idObjeto = $_POST['idObjeto'];

$modificacion_format_uniforme = "UPDATE uniformes SET %s WHERE id_uniforme = $idObjeto";
$modificacion_condiciones_uniforme = array();

if($generoUniformeModificado != "") {
  array_push($modificacion_condiciones_uniforme, "genero='$generoUniformeModificado'");

$modificacion_sql = sprintf($modificacion_format_uniforme, implode(", ", $modificacion_condiciones_uniforme));

echo 'formateado: ' . $modificacion_sql;

$resultado = mysqli_query($con, $modificacion_sql); 
}
?>