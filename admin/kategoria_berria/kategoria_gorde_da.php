<?php
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak.php';
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/kategoriak/kategoriak_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);

    if ($nombre === '') {
        header("Location: kategoria_ez_da_gorde.php");
        exit;
    }

    $categoria = new Categorias();
    $categoria->setNombre($nombre);

    $ok = CategoriasDB::insertCategoria($categoria);

    if ($ok) {
        header("Location: ../index.php");
        exit;
    } else {
        header("Location: kategoria_ez_da_gorde.php");
        exit;
    }
}
?>
