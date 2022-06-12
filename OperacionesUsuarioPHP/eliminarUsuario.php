<?php
include("conexion.php");
$idUsuario = $_POST['id_usuario'];
$baja = "UPDATE personas SET baja=1
        WHERE id_persona=$idUsuario";
$resultado = mysqli_query($con,$baja);       



?>