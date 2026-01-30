<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php"); // Login dentro del admin
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error al actualizar categoría</title>
</head>
<body>
<h1>No se pudo actualizar la categoría</h1>
<p>Revisa los datos introducidos.</p>
<p>
    <a href="kategoria_aldatu.php?id=<?= $_POST['id_categoria'] ?? 0 ?>">← Volver al formulario</a>
</p>
<p>
    <a href="index.php">← Volver al panel</a> <!-- Esto apunta al index dentro del admin -->
</p>
</body>
</html>
