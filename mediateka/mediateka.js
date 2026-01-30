document.addEventListener("DOMContentLoaded", () => {

// === 0. CARRUSEL AUTOMÁTICO (Añadido) ===
    let currentIndex = 0;
    let autoPlayInterval;

    window.moveSlide = (direction) => {
        const track = document.getElementById('track');
        const items = document.querySelectorAll('.carousel-item');
        if (!track || items.length === 0) return;

        currentIndex += direction;

        // Loop infinito
        if (currentIndex >= items.length) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = items.length - 1;
        }

        const percentage = currentIndex * -100;
        track.style.transform = `translateX(${percentage}%)`;
        
        // Reiniciar el contador de 5s al hacer click manual
        resetAutoPlay();
    };

    function startAutoPlay() {
        autoPlayInterval = setInterval(() => {
            moveSlide(1);
        }, 5000); // 5 segundos
    }

    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    }

    // Iniciar el carrusel automático
    startAutoPlay();
    
    
    // === 1. SONIDOS MÁGICOS (Iconos) ===
    const sounds = {
        cards: document.getElementById('sound-cards'),
        coins: document.getElementById('sound-coins'),
        wand: document.getElementById('sound-wand')
    };

    const icons = {
        cards: document.getElementById('icon-cards'),
        coins: document.getElementById('icon-coins'),
        wand: document.getElementById('icon-wand')
    };

    function playMagicSound(sound) {
        if (sound) {
            sound.currentTime = 0;
            sound.play();
        }
    }

    if (icons.cards) icons.cards.onclick = () => playMagicSound(sounds.cards);
    if (icons.coins) icons.coins.onclick = () => playMagicSound(sounds.coins);
    if (icons.wand) icons.wand.onclick = () => playMagicSound(sounds.wand);

    // === 2. AUDIO ESTÁNDAR ===
    const nireAudioa = document.getElementById('audioEstandarra');
    const volRange = document.getElementById('volRange');
    const volValue = document.getElementById('volValue');

    window.playAudio = () => nireAudioa?.play();
    window.pauseAudio = () => nireAudioa?.pause();

    if (volRange) {
        volRange.oninput = (e) => {
            const val = e.target.value;
            nireAudioa.volume = val;
            volValue.innerText = Math.round(val * 100) + "%";
        };
    }

    // === 3. VIDEO PLAYER (Ibai, Willy, Nil) ===
    const bideoa = document.getElementById("erreproduzitzailea");
    const bideoHautatzailea = document.getElementById("bideoHautatzailea");

    // Rutas actualizadas según tu petición
    const bideoIturriak = {
        "bideo1": "multimedia/gomabrazo.mp4",
        "bideo2": "multimedia/rompergoma.mp4",
        "bideo3": "multimedia/desaparicionmoneda.mp4"
    };

    function aldatuBideoa() {
        if (!bideoHautatzailea || !bideoa) return;
        const ruta = bideoIturriak[bideoHautatzailea.value];
        bideoa.src = ruta;
        bideoa.load();
        // Nota: El play() puede fallar si el usuario no ha interactuado aún con la página
        bideoa.play().catch(() => console.log("Esperando interacción para reproducir"));
    }

    if (bideoHautatzailea) bideoHautatzailea.onchange = aldatuBideoa;

    // Botones de control de vídeo
    const btnMap = {
        "pauseBtn": () => bideoa.pause(),
        "playBtn": () => bideoa.play(),
        "stopBtn": () => { bideoa.pause(); bideoa.currentTime = 0; },
        "muteBtn": function() { 
            bideoa.muted = !bideoa.muted; 
            this.textContent = bideoa.muted ? "UNMUTE" : "MUTE"; 
        },
        "volPlusBtn": () => { if(bideoa.volume < 0.9) bideoa.volume += 0.1; },
        "volMinusBtn": () => { if(bideoa.volume > 0.1) bideoa.volume -= 0.1; }
    };

    // Asignar eventos a los botones si existen
    Object.keys(btnMap).forEach(id => {
        const btn = document.getElementById(id);
        if (btn) btn.onclick = btnMap[id];
    });

    // Cargar el primer video por defecto
    aldatuBideoa();
});