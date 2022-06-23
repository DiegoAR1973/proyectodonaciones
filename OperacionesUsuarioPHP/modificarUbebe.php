<?php
include("conexion.php");
include('modificacionObjeto.php');


$claseUtilesModificado = $_POST['ubb'];

$modificacion_format_uBebe = "UPDATE utiles_bebe SET %s WHERE fk_objeto_utiles_bebe = $idObjeto";
$modificacion_condiciones_uBebe = array();

if($claseUtilesModificado != "") {
  array_push($modificacion_condiciones_uBebe, "clase_utiles='$claseUtilesModificado'");


$modificacion_sql = sprintf($modificacion_format_uBebe, implode(", ", $modificacion_condiciones_uBebe));


$resultado = mysqli_query($con, $modificacion_sql); 
}
?>