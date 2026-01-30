<?php
// Archivo: mezua_ez_da_gorde.php
// Usamos el contexto de index.php para las variables ($izena, etc.)
?>
<link rel="stylesheet" href="../css/styles.css">

<div id="mezua_edukia" class="container-form" style="padding: 20px;">

    <div class="alerta error">
        <p>Mezua ez da gorde (El mensaje no se ha guardado)</p>
    </div>
    
    <h2 style="margin-top: 20px;">Datos No Guardados</h2>

    <table class="cesta-table" style="margin: 20px auto; width: 90%;">
        <tbody>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold;">Izena (Nombre):</td>
                <td><?php echo htmlspecialchars($izena ?? ''); ?></td>
            </tr>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold;">Email:</td>
                <td><?php echo htmlspecialchars($email ?? ''); ?></td>
            </tr>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold;">Mezuaren testua:</td>
                <td><?php echo htmlspecialchars($mezuaren_testua ?? ''); ?></td>
            </tr>
        </tbody>
    </table>
    
    <div style="margin-top: 30px;">
        <a href="index.php" class="explore-button" style="width: 100%; display: block; text-align: center; margin: 0 auto;">Itzuli (Volver)</a>
    </div>

</div>