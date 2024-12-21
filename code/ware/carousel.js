document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.profilepicture');
    carousels.forEach(function(carousel, index) {
        const slides = carousel.querySelector('.carousel-inner').querySelectorAll('.carousel-item');
        const totalSlides = slides.length;
        let currentIndex = 0;
        let intervalId;

        const carouselInner = carousel.querySelector('.carousel-inner');
        const prevButton = carousel.querySelector('.prev');
        const nextButton = carousel.querySelector('.next');

        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateCarousel();
        }

        function updateCarousel() {
            const offset = -currentIndex * 100; // Assuming each slide is 100% wide
            carouselInner.style.transform = `translateX(${offset}%)`;
        }

        function startAutoSlide() {
            intervalId = setInterval(nextSlide, 3000);
        }

        function stopAutoSlide() {
            clearInterval(intervalId);
        }

        function resetAutoSlide() {
            stopAutoSlide();
            startAutoSlide();
        }

        startAutoSlide();

        nextButton.addEventListener('click', function() {
            nextSlide();
            resetAutoSlide();
        });

        prevButton.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateCarousel();
            resetAutoSlide();
        });
    });
});