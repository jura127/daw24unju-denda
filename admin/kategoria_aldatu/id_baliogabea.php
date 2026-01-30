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
    <title>ID de Categoría Inválido</title>
</head>
<body>
    <h1>ID de Categoría Inválido</h1>
    <p>La categoría que intentas editar no existe o el ID proporcionado no es válido.</p>
    <p><a href="../index.php">← Volver al panel</a></p>
</body>
</html>
