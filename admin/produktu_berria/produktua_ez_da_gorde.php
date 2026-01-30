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
<title>Error al guardar producto</title>
</head>
<body>
<h1>No se pudo guardar el producto</h1>
<p>Revisa los datos introducidos o el tamaño del vídeo.</p>
<p><a href="produktua_berria.php">← Volver al formulario</a></p>
<p><a href="../index.php">← Volver al panel</a></p>
</body>
</html>
