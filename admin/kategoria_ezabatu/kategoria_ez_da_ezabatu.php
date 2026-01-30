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
    <title>Kategoria Ez Da Ezabatu</title>
</head>
<body>
    <h1>Error</h1>
    <p>No se pudo eliminar la categoría. Inténtalo de nuevo más tarde.</p>
    <p><a href="../index.php">← Volver al panel</a></p>
</body>
</html>
