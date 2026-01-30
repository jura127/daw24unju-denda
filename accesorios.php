<?php
require_once 'config.php';

// --------------------
// INCLUSIÓN DE CLASES
// --------------------
require_once __DIR__ . '/klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';

// --------------------
// OBTENER PRODUCTOS DESDE LA BASE DE DATOS
// --------------------
// Asumimos que esta función devuelve objetos Productos con getOfertas() y getNovedades()
$productos = ProductosDB::selectProduktuak() ?? [];

// Todos los productos se mostrarán como accesorios
$accesorios = [];
foreach ($productos as $p) {
    // Calculamos el precio de oferta si aplica (Descuento del 20%)
    $es_oferta = $p->getOfertas();
    $precio_final = $p->getPrecio();
    $precio_original = null;

    if ($es_oferta) {
        $precio_original = $precio_final;
        $precio_final = $precio_final * 0.8;
    }

    $accesorios[] = [
        'id' => $p->getIdProducto(),
        'nombre' => $p->getTipoProducto(),
        'precio' => $precio_final, // Precio final o precio normal
        'precio_original' => $precio_original, // Precio tachado si es oferta
        'ofertas' => $es_oferta,
        'novedades' => $p->getNovedades(), // Asumimos que este método existe
        'imagen_url' => 'img/placeholder.png'
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesorios - Tienda de Magia</title>
    <link rel="stylesheet" href="css/styles.css">
    </head>
<body>

<header class="grid-header">
    <div class="logo-container">
        <img src="img/cajaconcartas-modified.jpg" alt="Logo Tienda de Magia" class="logo">
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="index.php" >Inicio</a></li>
            <li><a href="catalogo.php">Catálogo</a></li>
            <li><a href="accesorios.php"class="active">Accesorios</a></li>
            <li><a href="contacto/index.php">Contacto</a></li>
            <li><a href="mediateka/mediateka.html">Mediateka</a></li>
            <li><a href="cesta.php">Cesta</a></li>
            <li>
                <?php if ($esta_logueado): ?>
                    <div class="user-info-nav">
                        <a href="login.php?action=logout" class="logout-link" title="Cerrar Sesión">Logout</a>
                        <span class="user-name">(<?= htmlspecialchars($nombre_usuario) ?>)</span>
                        
                    </div>
                <?php else: ?>
                    <a href="login.php">Login/Reg</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>

<main>
    <div class="section-container">
        <h1>Accesorios de Magia</h1>
        
        <div class="productos-seccion-grid">
            <?php if (empty($accesorios)): ?>
                <p class="no-productos">No hay accesorios disponibles en este momento.</p>
            <?php else: ?>
                <?php foreach ($accesorios as $producto): ?>
                    <div class="producto-card">


                        
                        <p class="producto-nombre"><?= htmlspecialchars($producto['nombre']) ?></p>

                        <div class="prices-container">
                            <?php if ($producto['ofertas']): ?>
                                <del class="original-price"><?= number_format($producto['precio_original'], 2) ?> €</del>
                                <span class="sale-price"><?= number_format($producto['precio'], 2) ?> €</span>
                            <?php else: ?>
                                <p class="producto-precio"><?= number_format($producto['precio'], 2) ?> €</p>
                            <?php endif; ?>
                        </div>
                        
                        <form action="cesta.php" method="post">
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <button type="submit" class="add-to-cart-btn">AÑADIR A LA CESTA</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<footer>
    <p>&copy; Tienda de Magia 2025. Todos los derechos reservados.</p>
</footer>

</body>
</html>