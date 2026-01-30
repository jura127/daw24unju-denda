<?php
// config.php

// 1. Iniciar la sesión solo si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Variables globales para usar en el Header de cualquier página
$esta_logueado = isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true;
$nombre_usuario = $_SESSION['nombre_usuario'] ?? 'Invitado';

// 3. (Opcional) Función para proteger páginas privadas
function checkAcceso() {
    if (!isset($_SESSION['usuario_logueado'])) {
        header('Location: login.php');
        exit;
    }
}
?>