<?php
   
    // voy a comprobar que el email de la persona existe en la BD
    function repEmail($persona) {
        $sql = "SELECT id_persona, email, nombre, password
                    FROM personas";
        include("conexion.php");
        $resultado = mysqli_query($con,$sql);
        $emailFind = false;
        $continuar = true;
        $emailIn = $persona->get_email();
        
            // voy a buscar el email introducido en la BD, si existe devolvera true y no daremos de alta, si no existe devolverá false y si daremos de alta
            while($fila =  mysqli_fetch_assoc($resultado) and $continuar) {
                $emailConsult = $fila['email'];
                

                
                if($emailConsult ==  $emailIn){
                    $emailFind = true;
                    $continuar = false;
                    echo $emailIn;
                    echo $emailConsult;
                    echo '<br/>';
                } else {
                    $emailFind = false;
                }
                
            }

            mysqli_free_result($resultado);
    

        return $emailFind;
    }

    // voy a comprobar el rol del usuario
    function tipoUsuario($persona) {
       // tipoUsuario si 1 Donante, si 2 Donatario, si 3 Donante-Donatario
        $tipoUsuario = 1;
        
        // Si actua como donante y además como donatario lo debo incluir en ambas tablas
       if($persona->get_actua() =='donatario' || $persona->get_actua() =='donante_donatario'){
            if($persona->get_actua() =='donante_donatario') {
                $tipoUsuario = 3;                
            } else {
                $tipoUsuario = 2;
            }
        }
        return $tipoUsuario;       
    }

    // voy a comprobar el tipo de documento que va a introducir 
    function tipoDocumento(){


    }

?>