<?php
require "../Modelo/conexion.php";

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM usuarios WHERE id=$id";
if ($conn->query($sql)) {
    header('Location: ../index.php');
    exit;
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}
?>