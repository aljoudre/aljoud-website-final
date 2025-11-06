<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #005B4E;
            --color-background: #F5F5F5;
            --color-text: #222222;
        }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--color-text);
            background-color: var(--color-background);
        }
        .text-primary { color: var(--color-primary); }
        .bg-primary { background-color: var(--color-primary); }
        
        .section {
            padding: 8rem 0;
        }

        /* Gallery scroll snap container */
        .scroll-container {
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* For Firefox */
        }
        .scroll-container::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }
        .scroll-item {
            scroll-snap-align: center;
        }

        /* Updated dot-indicator for a rice-like shape */
        .dot-indicator {
            width: 1.5rem;
            height: 0.25rem;
            border-radius: 0.25rem;
            background-color: #d1d5db; /* A light gray */
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dot-indicator.active {
            background-color: #005B4E;
        }

    </style>
</head>
<body class="bg-[#F5F5F5] antialiased">

    <!-- Header -->
    <header class="bg-white shadow-sm py-4">
        <nav class="container mx-auto px-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-[#005B4E]">GLB.</a>
            <a href="#" class="text-gray-600 hover:text-[#005B4E] transition-colors">Back to Projects</a>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="relative flex items-center justify-center h-screen overflow-hidden">
            <img class="w-full h-full object-cover" src="https://placehold.co/1920x1080/005B4E/F5F5F5?text=Project+Hero+Image" alt="Placeholder hero image for the project">
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center p-8 sm:p-16">
                <h1 class="text-white text-3xl sm:text-5xl font-bold text-center">Modern Living at Its Finest</h1>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="relative h-screen bg-black">
            <!-- Image Carousel Container -->
            <div id="image-carousel" class="scroll-container flex w-full h-full overflow-x-auto snap-x">
                <!-- Gallery Item 1 -->
                <div class="scroll-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full flex items-center justify-center">
                    <img class="h-full w-full object-cover" src="https://placehold.co/1200x800/222222/F5F5F5?text=Gallery+Image+1" alt="Gallery Image 1">
                </div>
                <!-- Gallery Item 2 -->
                <div class="scroll-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full flex items-center justify-center">
                    <img class="h-full w-full object-cover" src="https://placehold.co/1200x800/005B4E/F5F5F5?text=Gallery+Image+2" alt="Gallery Image 2">
                </div>
                <!-- Gallery Item 3 -->
                <div class="scroll-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full flex items-center justify-center">
                    <img class="h-full w-full object-cover" src="https://placehold.co/1200x800/F5F5F5/222222?text=Gallery+Image+3" alt="Gallery Image 3">
                </div>
                <!-- Gallery Item 4 -->
                <div class="scroll-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full flex items-center justify-center">
                    <img class="h-full w-full object-cover" src="https://placehold.co/1200x800/222222/F5F5F5?text=Gallery+Image+4" alt="Gallery Image 4">
                </div>
                <!-- Gallery Item 5 -->
                <div class="scroll-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 h-full flex items-center justify-center">
                    <img class="h-full w-full object-cover" src="https://placehold.co/1200x800/005B4E/F5F5F5?text=Gallery+Image+5" alt="Gallery Image 5">
                </div>
            </div>

            <!-- Navigation Arrows -->
            <div class="absolute inset-y-0 left-0 flex items-center z-10 p-4">
                <button id="prev-btn" class="bg-white bg-opacity-50 p-3 rounded-full shadow-lg text-gray-800 hover:bg-opacity-75 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center z-10 p-4">
                <button id="next-btn" class="bg-white bg-opacity-50 p-3 rounded-full shadow-lg text-gray-800 hover:bg-opacity-75 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Dot Indicators -->
            <div id="indicators" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                <div class="dot-indicator active"></div>
                <div class="dot-indicator"></div>
                <div class="dot-indicator"></div>
                <div class="dot-indicator"></div>
                <div class="dot-indicator"></div>
            </div>
        </section>

        <!-- Simple Content Section -->
        <section id="content" class="container mx-auto px-4 py-12 text-center">
            <h2 class="text-3xl font-bold mb-4 text-[#005B4E]">A Vision of Refinement</h2>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto">
                Discover a new standard of luxury where every detail is crafted for your comfort and aesthetic pleasure. Our project offers a serene escape with sophisticated design and world-class amenities, all within a vibrant community.
            </p>
        </section>

        <!-- Map Section -->
        <section id="map-section" class="py-12 px-4 container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-8 text-[#005B4E]">Location</h2>
            <div class="relative w-full h-[50vh] rounded-xl overflow-hidden shadow-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d153164.81056581898!2d46.7214631!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f0a1c3e1e9a9b%3A0x3c7e46c7d2c3e1b1!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1677271927777!5m2!1sen!2sus" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="container mx-auto px-4 py-12">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-3xl font-bold text-center mb-6 text-[#005B4E]">Register Your Interest</h2>
                <form class="max-w-xl mx-auto">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#005B4E]" placeholder="Enter your full name">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#005B4E]" placeholder="Enter your email address">
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#005B4E]" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#005B4E] text-white py-3 rounded-lg font-semibold hover:bg-[#004a40] transition-colors">
                        Submit
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-[#222222] text-[#F5F5F5] py-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Global Luxury Brands. All rights reserved.</p>
        </div>
    </footer>

    <script>
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
    </script>
</body>
</html>
