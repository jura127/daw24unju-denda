<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error al Eliminar Mensaje</title>
</head>
<body>
    <h1>Mezua Ez Da Ezabatu</h1>
    <p>No se pudo eliminar el mensaje. Inténtalo de nuevo más tarde.</p>
    <p><a href="../index.php">← Volver al panel</a></p>
</body>
</html>