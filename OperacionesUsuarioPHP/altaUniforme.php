<?php
//recojo el valor del id_ropa dado de alta para este objeto y será la fk_ropa_uniforme
$sqlIdRopa = "SELECT id_ropa FROM ropa
                ORDER BY id_ropa DESC
                LIMIT 1";
$resultado_select_id_ropa = mysqli_query($con,$sqlIdRopa);       
$filaRopa = mysqli_fetch_row($resultado_select_id_ropa);
$idRopa = $filaRopa[0]; // valor fk_ropa_uniforme
echo $idRopa;
// recojo el valor del id_colegio que será la fk_colegio_uniforme
$nombreColegio = $_POST['nColegio'];
echo $nombreColegio.'<br>';
$sqlColegio = "SELECT id_colegio FROM colegios
                    WHERE  nombre = '$nombreColegio'";
$resultado_select_id_Colegio = mysqli_query($con,$sqlColegio);       
$filaColegio = mysqli_fetch_row($resultado_select_id_Colegio);
$idColegio = $filaColegio[0];
echo $idColegio.'<br>';

//include('conexion.php');
$sqlUniforme = "INSERT INTO uniformes (genero,fk_ropa_uniforme,fk_colegio_uniforme)    
                    VALUES ('$generoIn','$idRopa','$idColegio')";


?>