<?php
session_start();
// Control de acceso: Solo administradores pueden ver esta página de error
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    // Redirige al login, ajusta la ruta si es necesario
    header("Location: ../login.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Error: ID de Mensaje Inválido</title>
</head>
<body>

<h1>Errorea: ID Baliogabea (Error: ID Inválido)</h1>

<p>
    El identificador del mensaje proporcionado es inválido o el mensaje no existe en la base de datos.
</p>
<p>
    Por favor, verifica la URL o vuelve al panel de administración.
</p>

<p>
    <a href="../index.php">← Volver al panel de administración</a> 
</p>

</body>
</html>