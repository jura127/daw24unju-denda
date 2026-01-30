<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

// Asegúrate de que este método exista y devuelva un array (o un array vacío si no hay datos)
$categorias = CategoriasDB::selectCategorias() ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Producto</title>
</head>
<body>

<h1>Nuevo Producto</h1>
<form action="produktua_gorde_da.php" method="POST" enctype="multipart/form-data">
    <label for="tipo_producto">Tipo de producto:</label>
    <input type="text" id="tipo_producto" name="tipo_producto" required>
    <br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>
    <br><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" step="0.01" name="precio" required>
    <br><br>

    <label for="id_categoria">Categoría:</label>
    <select id="id_categoria" name="id_categoria" required>
        <option value="">Selecciona...</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat->getId() ?>"><?= htmlspecialchars($cat->getNombre()) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label for="video">Video (opcional):</label>
    <input type="file" id="video" name="video" accept="video/*">
    <br><br>

    <label>
        <input type="checkbox" name="tiene_opc_añadir_cesta" value="1"> Añadir a cesta
    </label>
    <br>
    <label>
        <input type="checkbox" name="ofertas" value="1"> Oferta
    </label>
    <br>
    <label>
        <input type="checkbox" name="novedades" value="1"> Novedad
    </label>
    <br><br>

    <button type="submit">Guardar producto</button>
</form>
<br>
<a href="../index.php">Volver al panel</a>
</body>
</html>