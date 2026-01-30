<?php
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

if (!isset($_GET['id'])) {
    die("Falta el ID del producto.");
}

$id = (int)$_GET['id'];
// Suponiendo que selectProducto devuelve un objeto Producto o null/false
$producto = ProductosDB::selectProducto($id);

if (!$producto) {
    die("Producto no encontrado.");
}

// Suponiendo que selectCategorias devuelve un array de objetos Categoria o un array vacío
$categorias = CategoriasDB::selectCategorias() ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar producto</title>
</head>
<body>
<h2>Modificar producto</h2>
<form action="produktua_aldatu_da.php" method="post">
    <input type="hidden" name="id_producto" value="<?= htmlspecialchars($producto->getIdProducto()) ?>">

    <label for="tipo_producto">Tipo de producto:</label>
    <input type="text" id="tipo_producto" name="tipo_producto" value="<?= htmlspecialchars($producto->getTipoProducto()) ?>" required>
    <br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?= htmlspecialchars($producto->getDescripcion()) ?></textarea>
    <br><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" step="0.01" name="precio" value="<?= htmlspecialchars($producto->getPrecio()) ?>" required>
    <br><br>

    <label for="id_categoria">Categoría:</label>
    <select id="id_categoria" name="id_categoria" required>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c->getId() ?>" <?= $producto->getIdCategoria() == $c->getId() ? 'selected' : '' ?>>
                <?= htmlspecialchars($c->getNombre()) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label for="video">Video (ruta):</label>
    <input type="text" id="video" name="video" value="<?= htmlspecialchars($producto->getVideo()) ?>">
    <br><br>

    <label>
        <input type="checkbox" name="tiene_opc_añadir_cesta" value="1" <?= $producto->getTieneOpcAñadirCesta() ? 'checked' : '' ?>> Tiene opción de añadir a cesta
    </label>
    <br>
    <label>
        <input type="checkbox" name="ofertas" value="1" <?= $producto->getOfertas() ? 'checked' : '' ?>> En oferta
    </label>
    <br>
    <label>
        <input type="checkbox" name="novedades" value="1" <?= $producto->getNovedades() ? 'checked' : '' ?>> Es novedad
    </label>
    <br><br>

    <input type="submit" value="Actualizar producto">
</form>
<br>
<a href="../index.php">Volver al panel</a>
</body>
</html>