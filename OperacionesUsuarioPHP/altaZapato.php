<?php

include('conexion.php');
include('altaObjeto.php');
mysqli_query($con,$sqlNuevoObjeto);





// recojemos los valores de edad 
$edadIn = 'null';

if(isset($_POST['edad'])){ 
    if(!empty($_POST['edad'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
        $valorEdad= $_POST['edad'];
        foreach($valorEdad as $seleccionado){
       
        $edadIn = $seleccionado;
        
        }
    }
} 

// recojemos el valor de tipo de calzado
$tipoIn = 'null';
if(isset($_POST['tipo'])){ 
    if(!empty($_POST['tipo'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
        $valorTipo= $_POST['tipo'];
        foreach($valorTipo as $seleccionado){
        
        $tipoIn = $seleccionado;
       
        }
    }
} 

// recojemos el valor del número del calzado
$numero = 'null';
if(isset($_POST['znumero'])){ 
    if(!empty($_POST['znumero'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
    $numero= $_POST['znumero'];
        
    }
} 


// damos de alta en la tabla zapatos
include('recuperarIdObjeto.php');
$sqlNuevoZapato = "INSERT INTO zapatos (genero,tipo,numero,fk_objeto_zapatos)    
                        VALUES ('$edadIn','$tipoIn','$numero','$idObjeto')";
mysqli_query($con,$sqlNuevoZapato);

mysqli_close($con);



?>