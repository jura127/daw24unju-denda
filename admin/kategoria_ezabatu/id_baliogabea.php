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
    <title>ID Baliogabea</title>
</head>
<body>
    <h1>ID Baliogabea</h1>
    <p>El identificador proporcionado no es válido o no existe.</p>
    <p><a href="../index.php">← Volver al panel</a></p>
</body>
</html>
