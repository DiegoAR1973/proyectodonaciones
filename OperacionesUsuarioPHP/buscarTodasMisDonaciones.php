<?php

$id_usuario = 1; 

$sqlMisDonaciones = "SELECT donantes.id_donante, objetos.id_objeto
                        FROM donantes
                        JOIN objetos ON donantes.id_donante = objetos.fk_donante_objeto
                        WHERE donantes.id_donante = $id_usuario";
include('conexion.php');
$busqueda = mysqli_query($con,$sqlMisDonaciones);

    
    $pantalla = "<table><caption><b>MIS DONACIONES</b></caption><tr><td><b>ID DONANTE</b></td><td><b>ID OBJETO</b></td></tr>";
    while ($resultado = mysqli_fetch_row($busqueda)){
       
        $pantalla = $pantalla . "<tr><td>$resultado[0]</td><td>$resultado[1]</td></tr>";  
    }
    $pantalla = $pantalla . "</table><br>";
    echo $pantalla;

?>