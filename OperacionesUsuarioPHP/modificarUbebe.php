<?php
include("conexion.php");
include('modificacionObjeto.php');


$claseUtilesModificado = $_POST['ubb'];

$modificacion_format_uBebe = "UPDATE utiles_bebe SET %s WHERE fk_objeto_utiles_bebe = $idObjeto";
$modificacion_condiciones_uBebe = array();

if($claseUtilesModificado != "") {
  array_push($modificacion_condiciones_uBebe, "clase_utiles='$claseUtilesModificado'");

echo 'array: ' . print_r($modificacion_condiciones_uBebe);

$modificacion_sql = sprintf($modificacion_format_uBebe, implode(", ", $modificacion_condiciones_uBebe));

echo 'formateado: ' . $modificacion_sql;

$resultado = mysqli_query($con, $modificacion_sql); 
}
?>