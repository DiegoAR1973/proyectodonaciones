<?php
// use Cloudinary\Api\Upload\UploadApi;
// include('../cloudinary.php');
include("conexion.php");

// $data = (new UploadApi())->upload('C:\Users\kleov\Downloads\bg.png');

// echo "Url = ".$data['secure_url']

$idArticulo = $_POST['idArticulo'];

$consulta_objeto = "SELECT o.id_objeto, o.descripcion, o.fecha_alta, o.baja, p.nombre, p.email, p.baja as 'persona_baja', cp.cp, prov.nombre_provincia, c.nombre_ciudad FROM objetos o JOIN personas p ON o.fk_donante_objeto = p.id_persona JOIN cp ON o.fk_cp = cp.id_cp
JOIN provincia prov ON cp.fk_provincia = prov.id_provincia
JOIN ciudad c ON cp.fk_ciudad = c.id_ciudad WHERE id_objeto = %d";

$consulta_objeto_sql = sprintf($consulta_objeto, $idArticulo);

$resultado = mysqli_query($con, $consulta_objeto_sql);
$arrayResultados = mysqli_fetch_assoc($resultado);

echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>