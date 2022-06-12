<?php

$descripcion = $_POST['descripcion'];

// compruebo si hay descripción del objeto, si no la hay le doy el valor null para luego insertala en la BD
if($descripcion == ''){
    $descripcion = null;
}
$cpObjeto = $_POST['cpObjeto'];
echo 'codigo Postal objeto '.$cpObjeto."<br/>";
include("conexion.php");
// vamos a sacar la fk_cp
$sqlCP = "SELECT id_cp FROM cp
            WHERE cp = '$cpObjeto'";
$resultado = mysqli_query($con,$sqlCP);       
$fila = mysqli_fetch_row($resultado);
$idCP = $fila[0]; // esta será mi fk_cp de la tabla Objeto
echo 'fk_cp de la tabla objeto '.$idCP.'<br/>';

/* la fk_doante para objeto la tendré ya que el usuario se deberá haber registrado como donante para poder tener acceso a esta página
así que para las pruebas la pongo yo*/

$fk_donante = $_POST['idUsuario'];

// ya tengo todos los campos necesarios para dar de alta un objeto nuevo por lo que procedo a darle de alta

$sqlNuevoObjeto = "INSERT INTO objetos (descripcion,fk_cp,fk_donante_objeto)    
                        VALUES ('$descripcion','$idCP','$fk_donante')";


?>