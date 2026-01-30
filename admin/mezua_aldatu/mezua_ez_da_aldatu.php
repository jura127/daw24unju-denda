<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php"); // Login dentro del admin
    exit;
}

// Recoger el ID para que el usuario pueda volver a intentar la edición
$id_mensaje = intval($_GET['id'] ?? 0); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error al actualizar mensaje</title>
</head>
<body>
<h1>Mezua Ez Da Aldatu</h1>
<p>No se pudo actualizar el mensaje. Esto puede ser por:</p>
<ul>
    <li>Fallo en la conexión a la base de datos.</li>
    <li>No se introdujo ningún cambio.</li>
    <li>Algún dato obligatorio estaba vacío.</li>
</ul>
<p>
    <a href="mezua_aldatu.php?id=<?= $id_mensaje ?>">← Volver al formulario</a> 
</p>
<p>
    <a href="../index.php">← Volver al panel</a> 
</p>
</body>
</html>