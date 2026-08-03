document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".hero-slide");
    let index = 0;
    
    function showSlide(i) {
        slides.forEach((slide, idx) => {
            slide.style.opacity = idx === i ? "1" : "0";
            slide.style.transform = idx === i ? "scale(1)" : "scale(1.05)";
        });
    }

    function nextSlide() {
        index = (index + 1) % slides.length;
        showSlide(index);
    }

    function prevSlide() {
        index = (index - 1 + slides.length) % slides.length;
        showSlide(index);
    }

    // Botones manuales
    document.getElementById("next-btn").addEventListener("click", nextSlide);
    document.getElementById("prev-btn").addEventListener("click", prevSlide);

    // Cambio automático cada 4 segundos
    setInterval(nextSlide, 4000);

    // Mostrar la primera imagen
    showSlide(index);
    

});

