const carousel = document.getElementById('image-carousel');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const indicators = document.getElementById('indicators').children;

const scrollAmount = carousel.querySelector('.scroll-item').offsetWidth;

function updateIndicators() {
    const currentItemIndex = Math.round(carousel.scrollLeft / scrollAmount);
    for (let i = 0; i < indicators.length; i++) {
        if (i === currentItemIndex) {
            indicators[i].classList.add('active');
        } else {
            indicators[i].classList.remove('active');
        }
    }
}

prevBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
});

nextBtn.addEventListener('click', () => {
    carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
});

carousel.addEventListener('scroll', () => {
    updateIndicators();
});

// Initial update
updateIndicators();