<?php
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id_producto'];
    $tipo = trim($_POST['tipo_producto']);
    $desc = trim($_POST['descripcion']);
    $precio = (float)$_POST['precio'];
    $id_cat = (int)$_POST['id_categoria'];
    $video = trim($_POST['video']);
    $cesta = isset($_POST['tiene_opc_añadir_cesta']) ? 1 : 0;
    $oferta = isset($_POST['ofertas']) ? 1 : 0;
    $novedad = isset($_POST['novedades']) ? 1 : 0;

    // Crear objeto producto
    $producto = new Productos();
    $producto->setIdProducto($id);
    $producto->setTipoProducto($tipo);
    $producto->setDescripcion($desc);
    $producto->setPrecio($precio);
    $producto->setIdCategoria($id_cat);
    $producto->setVideo($video);
    $producto->setTieneOpcAñadirCesta($cesta);
    $producto->setOfertas($oferta);
    $producto->setNovedades($novedad);

    // Actualizar en la base de datos
    $ok = ProductosDB::updateProducto($producto);

    if ($ok) {
        header("Location: ../index.php");
        exit;
    } else {
        header("Location: ../produktua_aldatu/produktua_ez_da_aldatu.php");
        exit;
    }
}
?>
