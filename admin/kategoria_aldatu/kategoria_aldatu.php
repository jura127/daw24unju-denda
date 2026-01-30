<?php
session_start();
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$id = intval($_GET['id'] ?? 0);
$categoria = CategoriasDB::selectCategoria($id);
if (!$categoria) {
    die("Categoría no encontrada");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Categoría</title>
</head>
<body>
<h1>Editar Categoría</h1>
<form action="kategoria_aldatu_da.php" method="post">
    <input type="hidden" name="id_categoria" value="<?= $categoria->getId() ?>">
    <p>
        <label>Nombre:<br>
        <input type="text" name="nombre_categoria" value="<?= htmlspecialchars($categoria->getNombre()) ?>" required>
        </label>
    </p>
    <p><input type="submit" value="Guardar cambios"></p>
</form>
<a href="../index.php">← Volver al panel</a>
</body>
</html>
