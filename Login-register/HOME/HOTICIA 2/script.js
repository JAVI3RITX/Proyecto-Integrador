let currentIndex = 0;
const intervalTime = 5000; // Intervalo de cambio en milisegundos

function showSlide(index) {
    const carousel = document.querySelector('.carousel');
    const slideWidth = document.querySelector('.carousel img').clientWidth;
    carousel.style.transform = `translateX(${-index * slideWidth}px)`;
    currentIndex = index;
}

function nextSlide() {
    const totalSlides = document.querySelectorAll('.carousel img').length;
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

function prevSlide() {
    const totalSlides = document.querySelectorAll('.carousel img').length;
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}

// Cambiar automáticamente cada 5 segundos
setInterval(nextSlide, intervalTime);
