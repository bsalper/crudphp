<?php
require "../Modelo/conexion.php";

$id = $conn->real_escape_string($_POST['id']);
$rut = $conn->real_escape_string($_POST['rut']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);
$correo = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$comentario = $conn->real_escape_string($_POST['comentario']);

$sql = "UPDATE usuarios SET rut='$rut', nombre='$nombre', apellido='$apellido', correo='$correo', telefono='$telefono', comentario='$comentario' WHERE id=$id";
if ($conn->query($sql)) {
    header('Location: ../index.php');
    exit;
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}
?>
