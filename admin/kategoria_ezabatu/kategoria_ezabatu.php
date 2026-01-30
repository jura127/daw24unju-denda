<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/MAGIA_DENDA/klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php');
require($_SERVER['DOCUMENT_ROOT'] . '/MAGIA_DENDA/klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php');

// 🔒 Comprobación de sesión
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    header("Location: ../login.php");
    exit;
}

// 🧩 Validar el parámetro ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: id_baliogabea.php");
    exit;
}

$id = intval($_GET['id']);

// 🔎 Comprobar si la categoría existe antes de borrar
$categoria = CategoriasDB::selectCategoria($id);
if (!$categoria) {
    header("Location: id_baliogabea.php");
    exit;
}

// 🗑️ Intentar eliminar la categoría
$emaitza = CategoriasDB::deleteCategoria($id);

if ($emaitza) {
    header("Location: kategoria_ezabatu_da.php");
    exit;
} else {
    header("Location: kategoria_ez_da_ezabatu.php");
    exit;
}
?>
