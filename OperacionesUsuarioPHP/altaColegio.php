<?php
$nombreColegio = 'null';
$cpColegio = 'null';
if(isset($_POST['colegio'])){ 
    // si se ha chequeado la casilla uniforme
    $nombreColegio = $_POST['nColegio'];
    $cpColegio = $_POST['cpColegio'];
    // saco el id_cp del colegio que va a ser la fk_cp de la tabla Colegios
    $sqlColegioCP= "SELECT id_cp FROM cp
                WHERE cp = '$cpColegio'";
    $resultadoCPcolegio = mysqli_query($con,$sqlColegioCP);       
    $filaCPcolegio = mysqli_fetch_row($resultadoCPcolegio);
    $idCPcolegio =  $filaCPcolegio[0]; 

    // inserto en la tabla colegios los datos del colegio si no existe ya. OJO FALTA COMPROBAR QUE EL COLEGIO NO EXISTA YA PARA NO DUPLICAR
    include('conexion.php');
    $sqlAltaColegio = "INSERT INTO colegios (nombre,cp_colegio,fk_cp)    
                        VALUES ('$nombreColegio','$cpColegio','$idCPcolegio')"; 
}    
?>