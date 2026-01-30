<?php
session_start();
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php"); // dentro del admin
    exit;
}

$id = intval($_POST['id_categoria'] ?? 0);
$nombre = trim($_POST['nombre_categoria'] ?? '');

if ($id <= 0 || $nombre === '') {
    header("Location: kategoria_ez_da_aldatu.php");
    exit;
}

$categoria = new Categorias();
$categoria->setId($id);
$categoria->setNombre($nombre);

$filas = CategoriasDB::updateCategoria($categoria);

if ($filas > 0) {
    header("Location: ../index.php"); // redirige al index dentro del admin
    exit;
} else {
    header("Location: kategoria_ez_da_aldatu.php");
    exit;
}
