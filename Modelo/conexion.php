<?php

// Crear la conexión
$conn = new mysqli("localhost", "root", "", "crud");
// Reconoce tildes y eñes
$conn->set_charset("utf8");
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>