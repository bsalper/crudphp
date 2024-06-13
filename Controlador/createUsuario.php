<?php
require "../Modelo/conexion.php";

$rut = $conn->real_escape_string($_POST['rut']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);
$correo = $conn->real_escape_string($_POST['correo']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$comentario = $conn->real_escape_string($_POST['comentario']);

$stmt = $conn->prepare("INSERT INTO usuarios (rut, nombre, apellido, correo, telefono, comentario, fecha)
                        VALUES (?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssss", $rut, $nombre, $apellido, $correo, $telefono, $comentario);

if ($stmt->execute()) {
    header('Location: ../index.php');
    exit;
} else {
    echo "Error al insertar el registro: " . $stmt->error;
}

$stmt->close();
?>

