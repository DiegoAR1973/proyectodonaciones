<?php 
include('conexion.php');

$idObjeto = $_POST['idArticulo'];

$sql = "SELECT * FROM ropa WHERE fk_objeto = $idObjeto";

$resultado = mysqli_query($con, $sql);
$arrayResultados = mysqli_fetch_assoc($resultado);

echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>