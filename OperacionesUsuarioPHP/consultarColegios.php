<?php 
  include('conexion.php');

  $consulta_colegios = "SELECT nombre, cp_colegio FROM colegios";

  $resultado = mysqli_query($con, $consulta_colegios);
  $arrayResultados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);
?>