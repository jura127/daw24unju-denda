<div id="mezua_edukia" class="container-form">
    <h2>Mezu Berria (Nuevo Mensaje)</h2>
    
    <form id="contactForm" method="post" action="index.php" style="position:relative; z-index:10;">
        
        <div>
            <label for="izena">Izena (Nombre):</label>
            <input type="text" id="izena" name="izena" maxlength="50" required placeholder="Introduce tu nombre" autocomplete="name" autofocus>
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="50" required placeholder="Introduce tu email" autocomplete="email">
        </div>
        
        <div>
            <label for="mezuaren_testua">Mezuaren testua (Contenido del Mensaje):</label>
            <textarea id="mezuaren_testua" name="mezuaren_testua" rows="6" required placeholder="Escribe tu mensaje secreto aquí..."></textarea>
        </div>
        
        <div style="display: flex; gap: 15px; margin-top: 10px;">
            
            <button type="submit" id="sendBtn" name="bidali" class="add-to-cart-btn" style="flex-grow: 1; margin-bottom: 0;">
                BIDALI (Enviar)
            </button>
            
            <a href="index.php" class="add-to-cart-btn" 
               style="flex-grow: 1; margin-bottom: 0; background-color: #ff4466; 
                      box-shadow: 0 4px 12px rgba(255, 68, 102, 0.4); text-align: center; 
                      text-decoration: none; padding: 12px 20px;">
                UTZI (Cancelar)
            </a>
            
        </div>
        
        <div id="contactResponse" style="margin-top:10px;color:green"></div>
    </form>
</div>