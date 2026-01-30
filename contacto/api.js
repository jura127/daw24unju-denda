document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    if (!form) return;

    // quitar listeners duplicados si existen
    form.onsubmit = null;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const btn = document.getElementById('sendBtn');
        btn.disabled = true;
        const fd = new FormData(form);
        fetch('index.php', { method: 'POST', body: fd })
            .then(r => r.text())
            .then(html => {
                document.getElementById('contactResponse').innerHTML = html;
                btn.disabled = false;
            })
            .catch(err => {
                console.error(err);
                document.getElementById('contactResponse').innerText = 'Error al enviar';
                btn.disabled = false;
            });
    });
});

function mezuaBidali() {
    // 1. Validar que los campos no estén vacíos
    if (document.getElementById('izena').value === '' || 
        document.getElementById('email').value === '' || 
        document.getElementById('mezuaren_testua').value === '') {
        
        alert("Eremu guztiak bete behar dira (Todos los campos deben rellenarse)");

    } else {
        // 2. Crear un objeto XMLHttpRequest
        var httpRequest = new XMLHttpRequest();

        // 3. Configurar la petición POST a index.php
        httpRequest.open("POST", "index.php", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // 4. Definir cómo se procesará la respuesta
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === 4) {
                if (httpRequest.status === 200) {
                    // Si es éxito, reemplaza el contenido de 'mezua' con la respuesta del servidor
                    document.getElementById('mezua_edukia').innerHTML = this.responseText;
                } else {
                    alert("Fallo komunikazioan: " + this.statusText);
                }
            }
        };

        // 5. Preparar y enviar los datos (serializados)
        var nombre = document.getElementById('izena').value;
        var email = document.getElementById('email').value;
        var mensaje = document.getElementById('mezuaren_testua').value;

        httpRequest.send("izena=" + encodeURIComponent(nombre) + 
                             "&email=" + encodeURIComponent(email) +
                             "&mezuaren_testua=" + encodeURIComponent(mensaje));
    }
}