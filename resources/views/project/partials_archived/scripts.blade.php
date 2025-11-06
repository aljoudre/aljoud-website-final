<script src="{{ asset('js/final_script.js') }}"></script>
<script>
    // Gallery indicator updates
    const galleryContainer = document.querySelector('.gallery-container');
    const indicators = document.querySelectorAll('#galleryIndicators > div');
    if (galleryContainer && indicators.length) {
        galleryContainer.addEventListener('scroll', () => {
            const scrollPos = galleryContainer.scrollLeft;
            const itemWidth = galleryContainer.offsetWidth;
            const activeIndex = Math.round(scrollPos / itemWidth);
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('bg-[#005A58]', index === activeIndex);
                indicator.classList.toggle('bg-gray-400', index !== activeIndex);
            });
        });
    }
</script>
</body>
</html>

