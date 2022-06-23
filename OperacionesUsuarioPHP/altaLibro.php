<?php
include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);



if(isset($_POST['colegio'])){ 
    // falta comprobar que no exista ya el colegio, si no existe entonces dar de alta
    include('altaColegio.php');
    mysqli_query($con,$sqlAltaColegio);

}
$claseLibro = 'null';
if(isset($_POST['claseLibro'])){ 
    $claseLibro = $_POST['claseLibro'];
}

$isbn = 'null';
$titulo = 'null';
$editorial = 'null';
if(isset($_POST['isbn'])){ 
    $isbn = $_POST['isbn'];
}
if(isset($_POST['tituloLibro'])){ 
    $titulo = $_POST['tituloLibro'];
}
if(isset($_POST['editorial'])){ 
    $editorial = $_POST['editorial'];
}

include('recuperarIdObjeto.php');
$sqlAltaLibro = "INSERT INTO libros (tipo,isbn,titulo,editorial,fk_objeto_libros)    
                        VALUES ('$claseLibro','$isbn','$titulo','$editorial','$idObjeto')"; 
mysqli_query($con,$sqlAltaLibro);





?>