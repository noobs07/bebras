document.addEventListener('DOMContentLoaded', function () {
    const carouselItems = document.querySelectorAll('[data-carousel-item]');
    const indicators = document.querySelectorAll('[data-carousel-slide-to]');
    let currentIndex = 0; // mulai dari slide pertama

    function showSlide(index) {
        carouselItems.forEach((item, i) => {
            item.style.opacity = (i === index) ? '1' : '0';
            item.style.zIndex = (i === index) ? '10' : '0';
        });

        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.add('bg-white');
                indicator.classList.remove('bg-white/50');
            } else {
                indicator.classList.add('bg-white/50');
                indicator.classList.remove('bg-white');
            }
        });

        currentIndex = index;
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            showSlide(index);
        });
    });

    document.querySelector('[data-carousel-prev]').addEventListener('click', () => {
        let newIndex = currentIndex - 1;
        if (newIndex < 0) newIndex = carouselItems.length - 1;
        showSlide(newIndex);
    });

    document.querySelector('[data-carousel-next]').addEventListener('click', () => {
        let newIndex = currentIndex + 1;
        if (newIndex >= carouselItems.length) newIndex = 0;
        showSlide(newIndex);
    });

    setInterval(() => {
        let newIndex = currentIndex + 1;
        if (newIndex >= carouselItems.length) newIndex = 0;
        showSlide(newIndex);
    }, 5000);

    // tampilkan slide pertama saat load
    showSlide(currentIndex);
});
