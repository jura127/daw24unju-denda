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
<title>Error al eliminar producto</title>
</head>
<body>
    <h1>No se pudo eliminar el producto</h1>
    <p>Puede que el producto no exista o se haya producido un error al intentar eliminarlo.</p>
    <p><a href="../index.php">← Volver al panel de administración</a></p>
</body>
</html>
