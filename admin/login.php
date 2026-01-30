<?php
session_start();

if (isset($_POST['erabiltzailea']) && isset($_POST['pasahitza'])) {
    
    // Saneamiento básico de las entradas
    $usuario_ingresado = htmlspecialchars($_POST['erabiltzailea']);
    $password_ingresada = $_POST['pasahitza'];

    // 1. ARREGLO SOLICITADO: Verificación directa de cadena (sin hash)
    if ($usuario_ingresado === "admin" && $password_ingresada === "admin") {
        
        $_SESSION['erabiltzailea'] = "admin";
        
        // 2. Corrección de Ruta: Usar ruta relativa para mayor flexibilidad
        header("Location: index.php"); 
        exit;
    } else {
        $errorea = "Erabiltzaile edo pasahitz okerra!";
    }
}
?>

<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<?php 
// Imprimir el error saneado
if (isset($errorea)): ?>
    <p style='color:red;'><?= htmlspecialchars($errorea) ?></p>
<?php endif; ?>

<form method="post">
    <p>
        <label for="erabiltzailea">Erabiltzaile-izena:</label>
        <input type="text" name="erabiltzailea" id="erabiltzailea" required>
    </p>
    <p>
        <label for="pasahitza">Pasahitza:</label>
        <input type="password" name="pasahitza" id="pasahitza" required>
    </p>
    <p><input type="submit" value="Sartu"></p>
</form>

</body>
</html>