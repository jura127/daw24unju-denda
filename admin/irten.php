<?php
session_start();

// Destruir sesión
session_unset();
session_destroy();

// Redirigir al login dentro del admin
header("Location: login.php");
exit;
?>
