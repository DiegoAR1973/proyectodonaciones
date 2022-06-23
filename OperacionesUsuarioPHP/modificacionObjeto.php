<?php
include("conexion.php");
$cpModificado = $_POST['cpObjeto'];
$descripcionModificado = $_POST['descripcion'];
$idObjeto = $_POST['idObjeto'];
$donado = $_POST['donado'];

$modificacion_format_objetos = "UPDATE objetos SET %s WHERE id_objeto = $idObjeto";
$modificacion_condiciones_objetos = array();

if($cpModificado != "") {

    $sqlCP = "SELECT id_cp FROM cp
    WHERE cp = '$cpModificado'";
    $resultado = mysqli_query($con,$sqlCP);       
    $fila = mysqli_fetch_row($resultado);
    $idCP = $fila[0];

  array_push($modificacion_condiciones_objetos, "fk_cp='$idCP'");
}
if($descripcionModificado !=""){
    array_push($modificacion_condiciones_objetos, "descripcion='$descripcionModificado'");
}
if($donado !=""){
    array_push($modificacion_condiciones_objetos, "donado='$donado'");
}


$modificacion_sql = sprintf($modificacion_format_objetos, implode(", ", $modificacion_condiciones_objetos));


if($cpModificado != "" || $descripcionModificado !="" || $donado !=""){
    $resultado = mysqli_query($con, $modificacion_sql); 
}

?>