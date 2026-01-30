<?php
// Asegúrate de iniciar la sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';
// --------------------
// INCLUSIÓN DE CLASES (Asegúrate de que estas rutas son correctas)
// --------------------
require_once __DIR__ . '/klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';


// =================================================================
// 1. CLASE CESTA (Lógica de Sesión)
// =================================================================
class Cesta {
    private const CESTA_KEY = 'cesta_productos';

    private static function inicializarCesta() {
        if (!isset($_SESSION[self::CESTA_KEY])) {
            // [id_producto => cantidad]
            $_SESSION[self::CESTA_KEY] = [];
        }
    }

    public static function anadirProducto(int $idProducto, int $cantidad = 1) {
        self::inicializarCesta();
        if (isset($_SESSION[self::CESTA_KEY][$idProducto])) {
            $_SESSION[self::CESTA_KEY][$idProducto] += $cantidad;
        } else {
            $_SESSION[self::CESTA_KEY][$idProducto] = $cantidad;
        }
    }

    public static function obtenerProductos(): array {
        self::inicializarCesta();
        return $_SESSION[self::CESTA_KEY];
    }

    public static function eliminarProducto(int $idProducto) {
        self::inicializarCesta();
        unset($_SESSION[self::CESTA_KEY][$idProducto]);
    }
    
    public static function vaciarCesta() {
        $_SESSION[self::CESTA_KEY] = [];
    }
}


// =================================================================
// 2. PROCESAMIENTO 'AÑADIR/ELIMINAR/VACIAR' (POST)
// =================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Manejar adición (viene de index.php)
    // Usamos 'producto_id' que es el nombre del campo en index.php
    $id_producto = isset($_POST['producto_id']) ? (int)$_POST['producto_id'] : 0;
    $cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;
    
    if ($id_producto > 0 && $cantidad > 0) {
        Cesta::anadirProducto($id_producto, $cantidad);
    } 
    
    // 2. Manejar eliminación (viene de esta misma página)
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id_eliminar'])) {
        Cesta::eliminarProducto((int)$_POST['id_eliminar']);
    }
    
    // 3. Manejar vaciar (viene de esta misma página)
    if (isset($_POST['accion']) && $_POST['accion'] === 'vaciar') {
        Cesta::vaciarCesta();
    }

    // Redirigir. Si es una adición, redirigimos al catálogo (index.php) para verlo.
    // Si es una acción de cesta, redirigimos a la cesta (cesta.php) para actualizar la vista.
    if (isset($_POST['accion'])) {
        header('Location: cesta.php'); 
    } else {
        header('Location: index.php');
    }
    exit;
}


// =================================================================
// 3. OBTENER DATOS DE LA CESTA PARA LA VISTA
// =================================================================
$productos_en_cesta = Cesta::obtenerProductos();
$detalle_cesta = [];
$total_cesta = 0;

if (!empty($productos_en_cesta)) {
    foreach ($productos_en_cesta as $id_producto => $cantidad) {
        // Obtenemos los detalles del producto de la base de datos
        $producto_db = ProductosDB::selectProducto($id_producto);
        
        if ($producto_db) {
            $precio_unitario = $producto_db->getPrecio();
            $subtotal = $precio_unitario * $cantidad;
            $total_cesta += $subtotal;
            
            $detalle_cesta[] = [
                'id' => $id_producto,
                'nombre' => $producto_db->getTipoProducto(),
                'precio_unitario' => $precio_unitario,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];
        } else {
            Cesta::eliminarProducto($id_producto); 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta de Compra | Tienda de Magia</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
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
            <li><a href="accesorios.php">Accesorios</a></li>
            <li><a href="contacto/index.php">Contacto</a></li>
            <li><a href="mediateka/mediateka.html">Mediateka</a></li>
            <li><a href="cesta.php"  class="active">Cesta</a></li>
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
    <div class="section-container" style="text-align: left;">
        <h1>Cesta Mágica (<?php echo count($productos_en_cesta); ?> artículos)</h1> 
    </div>

    <div class="section-container" style="padding-top: 0;">
        <h2>Artículos Añadidos</h2>
        
        <?php if (empty($detalle_cesta)): ?>
            <p class="no-productos">¡Tu cesta está vacía! Añade algo de magia.</p>
            <div style="margin-top: 40px;"><a href="index.php" class="btn-finalizar">Volver al Catálogo</a></div>
        <?php else: ?>
            <table class="cesta-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th style="width: 15%;">Precio Unitario</th>
                        <th style="width: 10%;">Cantidad</th>
                        <th style="width: 15%;">Subtotal</th>
                        <th style="width: 10%;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($detalle_cesta as $item): ?>
                    <tr>
                        <td data-label="Producto"><strong><?= htmlspecialchars($item['nombre']) ?></strong></td>
                        <td data-label="Precio Unitario"><?= number_format($item['precio_unitario'], 2) ?> €</td>
                        <td data-label="Cantidad"><?= $item['cantidad'] ?></td>
                        <td data-label="Subtotal"><strong><?= number_format($item['subtotal'], 2) ?> €</strong></td>
                        <td data-label="Acción">
                            <form action="cesta.php" method="post">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id_eliminar" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: right;">Total Final:</td>
                        <td><?= number_format($total_cesta, 2) ?> €</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="cesta-actions">
                <form action="cesta.php" method="post">
                    <input type="hidden" name="accion" value="vaciar">
                    <button type="submit" class="btn-vaciar">Vaciar Cesta</button>
                </form>
                
                <a href="checkout.php" class="btn-finalizar">Finalizar Compra</a>
            </div>

        <?php endif; ?>
    </div>
</main>

<footer>
    <p>&copy; Tienda de Magia 2025. Todos los derechos reservados.</p>
</footer>
</body>
</html>