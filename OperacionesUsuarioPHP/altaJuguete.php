<?php
include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);
$edad = 'null';
if(isset($_POST['edad'])){ 
    $edad = $_POST['edad'];
}
include('recuperarIdObjeto.php');
$sqlAltaLibro = "INSERT INTO juguetes (edad,fk_objeto_juguetes)    
                        VALUES ('$edad','$idObjeto')"; 
mysqli_query($con,$sqlAltaLibro);


?>