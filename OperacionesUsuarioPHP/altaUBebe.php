<?php

include('conexion.php');
include('altaObjeto.php');
// doy de alta un nuevo objeto
mysqli_query($con,$sqlNuevoObjeto);

// recojo los valores de la clase de objeto de utiles de bebé
$valorClaseUtilesBebe = 'null';
if(isset($_POST['ubb'])){ 
    if(!empty($_POST['ubb'])){
    // Bucle para recorrer el array de los checkBox y mostrar el elegido.
        $valorClaseUtilesBebe= $_POST['ubb'];
        foreach($valorClaseUtilesBebe as $seleccionado){
    
            $valorClaseUtilesBebe = $seleccionado;
        
        }
    }
} 
echo $valorClaseUtilesBebe;
// recupero el id del último objeto añadido que va a ser fk_objeto_zapatos de la tabla zapatos
include('recuperarIdObjeto.php');
$sqlNuevoUtilesBebe = "INSERT INTO utiles_bebe (clase_utiles,fk_objeto_utiles_bebe)    
                        VALUES ('$valorClaseUtilesBebe','$idObjeto')";
mysqli_query($con,$sqlNuevoUtilesBebe);

mysqli_close($con);





?>