<?php
session_start();
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';

// Validar campos obligatorios
if (empty($_POST['tipo_producto']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['id_categoria'])) {
    echo "Faltan datos obligatorios.";
    exit;
}

$produktua = new Productos();
$produktua->setTipoProducto(trim($_POST['tipo_producto']));
$produktua->setDescripcion(trim($_POST['descripcion']));
$produktua->setPrecio((float)$_POST['precio']);
$produktua->setIdCategoria((int)$_POST['id_categoria']);
$produktua->setTieneOpcAñadirCesta(isset($_POST['tiene_opc_añadir_cesta']) ? 1 : 0);
$produktua->setOfertas(isset($_POST['ofertas']) ? 1 : 0);
$produktua->setNovedades(isset($_POST['novedades']) ? 1 : 0);

// Subir vídeo si se ha enviado
$videoRuta = '';
if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $carpetaVideos = __DIR__ . '/../../videos/';
    if (!file_exists($carpetaVideos)) mkdir($carpetaVideos, 0777, true);
    $nombreArchivo = time() . "_" . basename($_FILES['video']['name']);
    $rutaDestino = $carpetaVideos . $nombreArchivo;
    if (move_uploaded_file($_FILES['video']['tmp_name'], $rutaDestino)) {
        $videoRuta = 'videos/' . $nombreArchivo;
    }
}
$produktua->setVideo($videoRuta);

// Guardar producto en la DB
$id = ProductosDB::insertProducto($produktua);
if ($id > 0) {
    header("Location: ../index.php");
    exit;
} else {
    echo "No se pudo guardar el producto. Revisa los datos introducidos o el vídeo.";
    exit;
}
?>
