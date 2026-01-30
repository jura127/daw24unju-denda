<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Producto eliminado</title>
</head>
<body>
    <h1>Producto eliminado correctamente</h1>
    <p><a href="../index.php">← Volver al panel de administración</a></p>
</body>
</html>
