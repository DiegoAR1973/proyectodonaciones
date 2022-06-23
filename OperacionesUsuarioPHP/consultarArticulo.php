<?php
// use Cloudinary\Api\Upload\UploadApi;
// include('../cloudinary.php');
include("conexion.php");

// $data = (new UploadApi())->upload('C:\Users\kleov\Downloads\bg.png');

$idArticulo = $_POST['idArticulo'];

$consulta_objeto = "SELECT 
  o.id_objeto,
  o.titulo,
  o.descripcion, 
  o.fecha_alta,
  o.imagen,
  o.baja, 
  p.nombre, 
  p.email, 
  p.baja as 'persona_baja', 
  cp.cp, 
  prov.nombre_provincia, 
  c.nombre_ciudad,
  co.id_clasificacion,
  co.nombre as 'tipo_objeto_nombre'
FROM objetos o 
LEFT JOIN clasificacion_objeto co ON o.fk_clasificacion_objeto_objetos = co.id_clasificacion
LEFT JOIN donantes dtes ON o.fk_donante_objeto = dtes.id_donante
LEFT JOIN personas p ON dtes.fk_persona_donante = p.id_persona
LEFT JOIN cp ON o.fk_cp_objeto = cp.id_cp
LEFT JOIN ciudad c ON cp.fk_cp_ciudad = c.id_ciudad
LEFT JOIN provincia prov ON c.fk_provincia_ciudad = prov.id_provincia
WHERE id_objeto = %d";

$consulta_objeto_sql = sprintf($consulta_objeto, $idArticulo);

$resultado = mysqli_query($con, $consulta_objeto_sql);
$arrayResultados = mysqli_fetch_assoc($resultado);

echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);

?>