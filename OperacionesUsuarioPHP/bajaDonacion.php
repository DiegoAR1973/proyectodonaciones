<?php
include("conexion.php");
$idObjeto = $_POST['bajaObjeto'];
$baja = "UPDATE objetos SET baja=1
        WHERE id_objeto=$idObjeto";
$resultado = mysqli_query($con,$baja);       



?>