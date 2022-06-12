<?php
$servername = "localhost";
$database = "donaciones";
$username = "root";
$password = "";
// Creo la conexión
$con = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$con) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}


?>