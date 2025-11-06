<script>
// Gallery Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const modal = document.getElementById('galleryModal');
    if (!modal) return;
    
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const prevImage = document.getElementById('prevImage');
    const nextImage = document.getElementById('nextImage');
    const imageCounter = document.getElementById('imageCounter');
    
    const galleryImages = @json(isset($galleryImages) && is_array($galleryImages) ? $galleryImages : []);
    let currentIndex = 0;
    
    function openModal(index) {
        currentIndex = index;
        updateModalImage();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModalFunc() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    function updateModalImage() {
        modalImage.src = galleryImages[currentIndex];
        imageCounter.textContent = `${currentIndex + 1} / ${galleryImages.length}`;
    }
    
    function showNext() {
        currentIndex = (currentIndex + 1) % galleryImages.length;
        updateModalImage();
    }
    
    function showPrev() {
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        updateModalImage();
    }
    
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => openModal(index));
    });
    
    closeModal.addEventListener('click', closeModalFunc);
    nextImage.addEventListener('click', showNext);
    prevImage.addEventListener('click', showPrev);
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModalFunc();
    });
    
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeModalFunc();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        }
    });
});
</script>

