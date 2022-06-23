<?php

include('conexion.php');
$id_usuario = $_POST['idUsuario'];
$categoriaObjeto = $_POST['categoria'];
$nombre = $_POST['nombre'];

$filtro = [];

if($id_usuario != "") {
    array_push($filtro, " o.fk_donante_objeto = $id_usuario ");
}
if($categoriaObjeto != "") {
    array_push($filtro, " o.fk_clasificacion_objeto_objetos = $categoriaObjeto ");
}
if($nombre != "") {
    array_push($filtro, " o.titulo LIKE '$nombre%' ");
}

$sqlMisDonaciones = "SELECT * FROM objetos o JOIN donantes dtes ON o.fk_donante_objeto = dtes.id_donante JOIN personas p ON dtes.fk_persona_donante = p.id_persona";

if(count($filtro)) {
    $sqlMisDonaciones .= " WHERE " . implode(" AND ", $filtro);
}



$resultado = mysqli_query($con, $sqlMisDonaciones);
$arrayResultados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>