<?php
include("conexion.php");
include('modificacionObjeto.php');

$generoModificado = $_POST['genero'];
$tipoModificado = $_POST['tipo'];
$numeroModificado = $_POST['znumero'];
echo 'genero modificado: '.$generoModificado.'<br/>';

$modificacion_format_zapato = "UPDATE zapatos SET %s WHERE fk_objeto_zapatos = $idObjeto";
$modificacion_condiciones_zapato = array();

if($generoModificado != "") {
  array_push($modificacion_condiciones_zapato, "genero='$generoModificado'");
}
if($tipoModificado !=""){
    array_push($modificacion_condiciones_zapato, "tipo='$tipoModificado'");
}


echo 'array: ' . print_r($modificacion_condiciones_zapato);

$modificacion_sql = sprintf($modificacion_format_zapato, implode(", ", $modificacion_condiciones_zapato));

echo 'formateado: ' . $modificacion_sql;

$resultado = mysqli_query($con, $modificacion_sql); 

?>