<?php
session_start();

// 🔐 Comprobar que sea admin
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// 📦 Cargar clases
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/produktuak/produktuak_db.php';

// 🧾 Verificar ID recibido
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
    header("Location: produktua_ez_da_ezabatu.php");
    exit;
}

// 🔍 Obtener producto de la BD
$produktua = ProductosDB::selectProducto($id);
if (!$produktua) {
    header("Location: produktua_ez_da_ezabatu.php");
    exit;
}

// 🗑️ Eliminar archivo de video si existe
if ($produktua->getVideo() && file_exists(__DIR__ . '/../../' . $produktua->getVideo())) {
    unlink(__DIR__ . '/../../' . $produktua->getVideo());
}

// 🧨 Eliminar producto
$rows = ProductosDB::deleteProducto($id);

if ($rows > 0) {
    header("Location: produktua_ezabatu_da.php");
    exit;
} else {
    header("Location: produktua_ez_da_ezabatu.php");
    exit;
}
