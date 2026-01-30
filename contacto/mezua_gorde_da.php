<?php

?>
<link rel="stylesheet" href="../css/styles.css">

<div class="section-container">
    <h2 style="color: #00ff88; text-shadow: 0 0 10px rgba(0, 255, 136, 0.7);">✓ Mezua gorde da</h2>
    
    <table class="cesta-table" style="margin: 40px auto; max-width: 600px;">
        <tbody>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold; width: 40%;">Izena:</td>
                <td style="color: #e6f7ff;"><?php echo htmlspecialchars($izena ?? ''); ?></td>
            </tr>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold; width: 40%;">Email:</td>
                <td style="color: #e6f7ff;"><?php echo htmlspecialchars($email ?? ''); ?></td>
            </tr>
            <tr>
                <td align="right" style="color: #00ff88; font-weight: bold; width: 40%;">Mezuaren testua:</td>
                <td style="color: #e6f7ff;"><?php echo htmlspecialchars($mezuaren_testua ?? ''); ?></td>
            </tr>
        </tbody>
    </table>
    
    <form action="." method="get" style="margin-top: 30px;">
        <p>
            <input type="submit" value="Itzuli (Volver)" class="explore-button" style="width: auto; padding: 12px 30px;">
        </p>
    </form>
</div>