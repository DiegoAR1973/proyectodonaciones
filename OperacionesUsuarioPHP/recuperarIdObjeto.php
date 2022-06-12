<?php

$sqlIdObjeto = "SELECT id_objeto FROM objetos 
                    ORDER BY id_objeto DESC
                    LIMIT 1";
$resultado_select_id_objeto = mysqli_query($con,$sqlIdObjeto);       
$filaObjeto = mysqli_fetch_row($resultado_select_id_objeto);
$idObjeto = $filaObjeto[0];

?>