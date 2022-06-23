<?php
include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);


// recogo los valores de edad, genero y talla de la tabla ropa
$edadIn = 'null';
$generoIn='null';
$tallaIn = 'null';

// comprobamos para que edad es la ropa
if(isset($_POST['edad'])){ 
    if(!empty($_POST['edad'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
        $edadIn = $_POST['edad']; 
    }
} 
// comrpobamos de que género es la ropa
if(isset($_POST['genero'])){ 
    if(!empty($_POST['genero'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
        $generoIn  = $_POST['genero'];   
    }
} 

// recogemos el valor de la talla
if(isset($_POST['talla'])){ 
    $tallaIn = $_POST['talla'];
}
// tengo ya todos los valores para dar de alta una donación de la clase ropa luego procedo a insertar los datos en la tabla ropa
include('recuperarIdObjeto.php'); // recuperamos el idObjeto
$sqlRopa = "INSERT INTO ropa (edad,genero,talla,fk_objeto_ropa)    
                VALUES ('$edadIn','$generoIn','$tallaIn','$idObjeto')"; 
mysqli_query($con,$sqlRopa);

 // comprobamos si la ropa pertenece a un uniforme escolar
if(isset($_POST['colegio'])){ 
    // ejecuto el alta del nuevo colegio. OJO FALTA COMPROBAR QUE EL NUEVO COLEGIO NO EXISTA YA EN LA BD
    include('altaColegio.php');
    mysqli_query($con, $sqlAltaColegio);

    // ejecuto el alta del uniforme
    include('altaUniforme.php');
    mysqli_query($con, $sqlUniforme);    
} 
mysqli_close($con);
?>