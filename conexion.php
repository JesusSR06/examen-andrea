<?php

define('DB_SERVER', 'localhost');//nombre del servidor

define('DB_USERNAME', 'root');//nombre de usuario del servidor

define('DB_PASSWORD', '');//contraseña del servidor

define('DB_NAME', 'joyeria');//nombre de la base de datos

/* Prueba de conexión a la base de datos MySQL*/

$conexion = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Se verifica la conexión, si no se puede realizar se indica el error

if($conexion === false){

    die("ERROR: No se puede conectar. " . mysqli_connect_error());

}

?>