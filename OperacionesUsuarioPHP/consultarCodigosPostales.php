<?php 
  include('conexion.php');

  $consulta_codigos_postales = "SELECT id_cp, cp FROM cp";

  $resultado = mysqli_query($con, $consulta_codigos_postales);
  $arrayResultados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);
?>