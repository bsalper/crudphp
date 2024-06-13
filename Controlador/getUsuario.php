<?php
require "../Modelo/conexion.php";

$id = $conn->real_escape_string($_POST['id']);

$sql = "SELECT id,rut,nombre,apellido,correo,telefono,comentario FROM usuarios WHERE id=$id LIMIT 1";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows;

$usuarios = [];

if ($rows > 0) {
    $usuarios = $resultado->fetch_array();
}

echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);
