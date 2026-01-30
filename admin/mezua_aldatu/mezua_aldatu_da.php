<?php
session_start();
// Asegúrate de que las rutas a tus clases sean correctas
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak.php'; 
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak_db.php';

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    // Redirección al login si no es admin
    header("Location: ../login.php"); 
    exit;
}

// 1. Recoger y sanear datos
$id = intval($_POST['id_mensaje'] ?? 0);
$nombre = trim($_POST['nombre_mensaje'] ?? '');
$email = trim($_POST['email_mensaje'] ?? '');
$mensaje_content = trim($_POST['contenido_mensaje'] ?? '');
$leido = intval($_POST['leido_mensaje'] ?? 0);

// 2. Validación de datos mínimos
if ($id <= 0 || $nombre === '' || $email === '' || $mensaje_content === '') {
    // Si la validación básica falla, redirigir al error genérico
    header("Location: mezua_ez_da_aldatu.php?id=$id"); 
    exit;
}

// 3. Crear el objeto Mensajes con los nuevos datos
$m = new Mensajes();
$m->setId($id);
$m->setNombre($nombre);
$m->setEmail($email);
$m->setMensaje($mensaje_content);
$m->setLeido($leido);
// No se necesita setFecha ya que la DB la gestiona automáticamente en la inserción
// y no la modificamos en la actualización

// 4. Intentar la actualización
$filas_afectadas = MensajesDB::updateMensajes($m);

if ($filas_afectadas > 0) {
    // Éxito: Redirige a la página principal del admin
    header("Location: ../index.php"); 
    exit;
} else {
    // Fallo: Redirige a la página de error
    // Nota: Esto también cubre el caso en que se intenta actualizar sin cambios (rowCount=0)
    header("Location: mezua_ez_da_aldatu.php?id=$id");
    exit;
}