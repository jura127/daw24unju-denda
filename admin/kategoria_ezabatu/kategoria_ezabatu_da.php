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
    <title>Categoria Eliminada</title>
</head>
<body>
    <h1>Categoria Eliminada</h1>
    <p>La categoría se ha eliminado correctamente.</p>
    <p><a href="../index.php">← Volver al panel de administración</a></p>
</body>
</html>
