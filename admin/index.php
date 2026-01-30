<?php
session_start();

// Mostrar errores solo en desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 🔐 Comprobar usuario admin
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: login.php");
    exit;
}

// 📦 Cargar clases necesarias
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

// AÑADIDO: Incluir las clases de Mensajes
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/mezuak/mezuak.php';
require_once __DIR__ . '/../klaseak/com/leartik/daw24unju/mezuak/mezuak_db.php';

// 🔹 Cargar datos desde la base de datos
$productos = ProductosDB::selectProduktuak() ?? [];
$categorias = CategoriasDB::selectCategorias() ?? [];

// AÑADIDO: Cargar todos los mensajes. El orden (ID descendente) se define en MensajesDB::selectAllMensajes()
$mensajes = MensajesDB::selectAllMensajes() ?? []; 

// 🔹 Crear mapa de categorías
$catMap = [];
foreach ($categorias as $c) {
    $catMap[$c->getId()] = $c->getNombre();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
</head>
<body>

<h1>Administración de Productos</h1>
<p>
    <a class="button" href="irten.php">Cerrar sesión</a>
    <a class="button" href="produktu_berria/produktua_berria.php">Añadir producto nuevo</a>
</p>

<table>
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Video</th>
            <th>Añadir a Cesta</th>
            <th>Ofertas</th>
            <th>Novedades</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p->getTipoProducto()) ?></td>
                    <td><?= htmlspecialchars($p->getDescripcion()) ?></td>
                    <td><?= number_format($p->getPrecio(), 2) ?> €</td>
                    <td><?= htmlspecialchars($catMap[$p->getIdCategoria()] ?? 'Sin categoría') ?></td>
                    <td>
                        <?php if (!empty($p->getVideo())): ?>
                            <video style="width:100px; height:100px; object-fit:cover;" controls>
                                <source src="../<?= htmlspecialchars($p->getVideo()) ?>" type="video/mp4">
                                Tu navegador no soporta el video.
                            </video>
                        <?php else: ?>
                            No
                        <?php endif; ?>
                    </td>
                    <td><?= $p->getTieneOpcAñadirCesta() ? 'Sí' : 'No' ?></td>
                    <td><?= $p->getOfertas() ? 'Sí' : 'No' ?></td>
                    <td><?= $p->getNovedades() ? 'Sí' : 'No' ?></td>
                    <td>
                        <a class="button" href="produktua_aldatu/produktua_aldatu.php?id=<?= $p->getIdProducto() ?>">Editar</a>
                        <a class="button" href="produktua_ezabatu/produktua_ezabatu.php?id=<?= $p->getIdProducto() ?>" onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">No hay productos registrados</td></tr>
        <?php endif; ?>
    </tbody>
</table>

---

<h1>Administración de Categorías</h1>
<p><a class="button" href="kategoria_berria/kategoria_berria.php">Añadir categoría nueva</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categorias)): ?>
            <?php foreach ($categorias as $c): ?>
                <tr>
                    <td><?= $c->getId() ?></td>
                    <td><?= htmlspecialchars($c->getNombre()) ?></td>
                    <td>
                        <a class="button" href="kategoria_aldatu/kategoria_aldatu.php?id=<?= $c->getId() ?>">Editar</a>
                        <a class="button" href="kategoria_ezabatu/kategoria_ezabatu.php?id=<?= $c->getId() ?>" onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No hay categorías registradas</td></tr>
        <?php endif; ?>
    </tbody>
</table>

---

<h1>Administración de Mensajes (Mezuak)</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Mensaje</th>
            <th>Leído</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($mensajes)): ?>
            <?php foreach ($mensajes as $m): ?>
                <tr>
                    <td><?= $m->getId() ?></td>
                    <td><?= htmlspecialchars($m->getFecha()) ?></td>
                    <td><?= htmlspecialchars($m->getNombre()) ?></td>
                    <td><?= htmlspecialchars($m->getEmail()) ?></td>
                    <td><?= htmlspecialchars(substr($m->getMensaje(), 0, 50)) . '...' ?></td>
                    <td><?= $m->getLeido() ? 'Sí' : 'No' ?></td>
                    <td>
                        <a class="button" href="mezua_aldatu/mezua_aldatu.php?id=<?= $m->getId() ?>">Ver/Editar</a> 
                        <a class="button" href="mezua_ezabatu/mezua_ezabatu.php?id=<?= $m->getId() ?>" onclick="return confirm('¿Eliminar mensaje?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No hay mensajes registrados</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<hr>

</body>
</html>