<?php
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir nueva categoría</title>
</head>
<body>

<h2>Añadir nueva categoría</h2>

<form action="kategoria_gorde_da.php" method="post">
    <label for="nombre">Nombre de la categoría:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br><br>
    <input type="submit" value="Guardar categoría">
</form>

<a href="../index.php">Volver al panel</a>

</body>
</html>