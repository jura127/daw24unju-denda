<?php
session_start();
// Asegúrate de que las rutas a tus clases sean correctas
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak.php'; 
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak_db.php';
// 🔒 Comprobación de sesión
if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== "admin") {
    // Redirecciona al login si no es admin
    header("Location: ../login.php");
    exit;
}

// 🧩 Validar el parámetro ID
if (!isset($_GET['id']) || !is_numeric($_GET['id']) || intval($_GET['id']) <= 0) {
    // Si el ID es inválido, redirige a la página de error específica de mensaje
    header("Location: id_baliogabea_mezua.php");
    exit;
}

$id = intval($_GET['id']);

// 🔎 Comprobar si el mensaje existe antes de borrar
// Esto es opcional, pero previene el borrado si ya no existe.
$mensaje = MensajesDB::selectMensajes($id);
if (!$mensaje) {
    header("Location: id_baliogabea_mezua.php");
    exit;
}

// 🗑️ Intentar eliminar el mensaje
// deleteMensajes devuelve el número de filas borradas (0 o 1)
$emaitza = MensajesDB::deleteMensajes($id);

if ($emaitza > 0) {
    // Éxito: Se ha borrado al menos una fila
    header("Location: mezua_ezabatu_da.php");
    exit;
} else {
    // Fallo: No se borró ninguna fila (puede ser por error de DB, aunque selectMensajes ya verificó la existencia)
    header("Location: mezua_ez_da_ezabatu.php");
    exit;
}
?>