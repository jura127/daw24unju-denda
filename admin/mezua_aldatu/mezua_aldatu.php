<?php
session_start();
// Asegúrate de que las rutas a tus clases sean correctas
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak.php'; 
require_once __DIR__ . '/../../klaseak/com/leartik/daw24unju/mezuak/mezuak_db.php'; 

if (!isset($_SESSION['erabiltzailea']) || $_SESSION['erabiltzailea'] !== 'admin') {
    header("Location: ../login.php"); 
    exit;
}

$id = intval($_GET['id'] ?? 0);

// 1. Obtener el mensaje de la base de datos
$mensaje = MensajesDB::selectMensajes($id);

if (!$mensaje) {
    // Si no se encuentra el mensaje, redirige a la página de ID inválido
    header("Location: id_baliogabea_mezua.php"); 
    exit;
}

// ==========================================================
// 🚨 LÓGICA DE ACTUALIZACIÓN AUTOMÁTICA (El cambio principal)
// ==========================================================

// 2. Verificar si el mensaje no está leído
if ($mensaje->getLeido() == 0) {
    // 3. Establecer 'leido' a 1
    $mensaje->setLeido(1); 
    
    // 4. Actualizar el registro en la base de datos
    // NOTA: Se llama a updateMensajes() y no se maneja el error de forma agresiva
    // para que la página cargue, incluso si la actualización falla.
    MensajesDB::updateMensajes($mensaje);
}

// ==========================================================

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Mensaje</title>
</head>
<body>
<h1>Editar Mensaje</h1>
<form action="mezua_aldatu_da.php" method="post">
    <input type="hidden" name="id_mensaje" value="<?= $mensaje->getId() ?>">
    
    <p>
        <label>ID:<br>
        <input type="text" value="<?= $mensaje->getId() ?>" disabled>
        </label>
    </p>
    
    <p>
        <label>Nombre:<br>
        <input type="text" name="nombre_mensaje" value="<?= htmlspecialchars($mensaje->getNombre()) ?>" required>
        </label>
    </p>
    
    <p>
        <label>Email:<br>
        <input type="email" name="email_mensaje" value="<?= htmlspecialchars($mensaje->getEmail()) ?>" required>
        </label>
    </p>

    <p>
        <label>Mensaje:<br>
        <textarea name="contenido_mensaje" rows="5" cols="40" required><?= htmlspecialchars($mensaje->getMensaje()) ?></textarea>
        </label>
    </p>
    
    <p>
        <label>Leído (0=No, 1=Sí):<br>
        <input type="number" name="leido_mensaje" value="<?= $mensaje->getLeido() ?>" min="0" max="1" required>
        </label>
    </p>

    <p><input type="submit" value="Guardar cambios"></p>
</form>
<p><a href="../index.php">← Volver al panel</a></p> 
</body>
</html>