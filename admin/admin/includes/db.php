<?php

$servername = "localhost:3308"; // Agrega el número de puerto después de dos puntos
$username = "root";
$password = "";
$db = "TiendaOnline";

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>