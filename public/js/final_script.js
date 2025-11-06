// Navigation: background on scroll + show/hide on direction
const nav = document.querySelector('.nav-container');
let lastScrollY = window.scrollY;
let ticking = false;
let hideTimeout = null;
let isHoveringNav = false;

// Keep nav visible while hovering
nav.addEventListener('mouseenter', () => {
    isHoveringNav = true;
    nav.classList.remove('navbar-hidden');
    nav.classList.add('navbar-visible');
    if (hideTimeout) {
        clearTimeout(hideTimeout);
        hideTimeout = null;
    }
});
nav.addEventListener('mouseleave', () => {
    isHoveringNav = false;
    const current = window.scrollY;
    const hero = document.getElementById('home');
    const heroTop = hero ? hero.offsetTop : 0;
    const heroBottom = hero ? (hero.offsetTop + hero.offsetHeight) : 0;
    const viewportMid = current + window.innerHeight / 2;
    const inHero = hero ? (viewportMid >= heroTop && viewportMid < heroBottom) : current < 50;
    if (!inHero) {
        nav.classList.remove('navbar-visible');
        nav.classList.add('navbar-hidden');
    }
});

function onScroll() {
    const current = window.scrollY;
    const hero = document.getElementById('home');
    const heroTop = hero ? hero.offsetTop : 0;
    const heroBottom = hero ? (hero.offsetTop + hero.offsetHeight) : 0;
    const viewportMid = current + window.innerHeight / 2;
    const inHero = hero ? (viewportMid >= heroTop && viewportMid < heroBottom) : current < 50;

    // Logo switching logic
    const logoNormal = document.getElementById('navbarLogo');
    const logoLight = document.getElementById('navbarLogoLight');
    
    if (!inHero && current > 100) {
        nav.classList.add('scrolled');
        // Switch to logo.png when scrolled (white background)
        if (logoNormal) logoNormal.classList.remove('hidden');
        if (logoLight) logoLight.classList.add('hidden');
    } else {
        nav.classList.remove('scrolled');
        // Switch to logo_light.svg when in hero (green background)
        if (logoNormal) logoNormal.classList.add('hidden');
        if (logoLight) logoLight.classList.remove('hidden');
    }

    if (inHero) {
        nav.classList.remove('navbar-hidden');
        nav.classList.add('navbar-visible');
        if (hideTimeout) {
            clearTimeout(hideTimeout);
            hideTimeout = null;
        }
    } else if (current > lastScrollY && current > 50) {
        nav.classList.remove('navbar-visible');
        nav.classList.add('navbar-hidden');
        if (hideTimeout) {
            clearTimeout(hideTimeout);
            hideTimeout = null;
        }
    } else {
        nav.classList.remove('navbar-hidden');
        nav.classList.add('navbar-visible');
        if (hideTimeout) {
            clearTimeout(hideTimeout);
        }
        hideTimeout = setTimeout(() => {
            if (!isHoveringNav) {
                nav.classList.remove('navbar-visible');
                nav.classList.add('navbar-hidden');
            }
        }, 1200);
    }

    // Mark active nav item
    const sections = document.querySelectorAll('section');
    const desktopNav = document.getElementById('desktopNav');
    const mobileNav = document.getElementById('mobileNav');
    const links = [
        ...(desktopNav ? desktopNav.querySelectorAll('a[data-target]') : []),
        ...(mobileNav ? mobileNav.querySelectorAll('a[data-target]') : [])
    ];
    let activeId = null;
    sections.forEach(section => {
        const top = section.offsetTop;
        const height = section.offsetHeight;
        if (viewportMid >= top && viewportMid < top + height) {
            activeId = section.id;
        }
    });
    if (links.length && activeId) {
        links.forEach(link => {
            if (link.dataset.target === activeId) {
                link.classList.add('border-b-2', 'border-current');
            } else {
                link.classList.remove('border-current');
            }
        });
    }

    lastScrollY = current <= 0 ? 0 : current;
    ticking = false;
}

window.addEventListener('scroll', function() {
    if (!ticking) {
        window.requestAnimationFrame(onScroll);
        ticking = true;
    }
});

// Sidebar toggle
const burger = document.getElementById('burger');
const sidebar = document.getElementById('sidebar');
const closeSidebar = document.getElementById('closeSidebar');

burger.addEventListener('click', () => {
    sidebar.classList.add('active');
});

closeSidebar.addEventListener('click', () => {
    sidebar.classList.remove('active');
});

document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });
});

function scrollToSection(id) {
    const section = document.getElementById(id);
    section.scrollIntoView({ behavior: 'smooth' });
}

// Language dropdown (desktop)
const langToggle = document.getElementById('langToggle');
const langMenu = document.getElementById('langMenu');
const langDropdown = document.getElementById('langDropdown');
if (langToggle && langMenu && langDropdown) {
    langToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        langMenu.classList.toggle('hidden');
    });
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!langDropdown.contains(e.target)) {
            langMenu.classList.add('hidden');
        }
    });
}

// Language dropdown (mobile/sidebar)
const langToggleMobile = document.getElementById('langToggleMobile');
const langMenuMobile = document.getElementById('langMenuMobile');
const langDropdownMobile = langToggleMobile ? langToggleMobile.closest('.relative') : null;
if (langToggleMobile && langMenuMobile) {
    langToggleMobile.addEventListener('click', (e) => {
        e.stopPropagation();
        langMenuMobile.classList.toggle('hidden');
    });
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (langDropdownMobile && !langDropdownMobile.contains(e.target)) {
            langMenuMobile.classList.add('hidden');
        }
    });
}

// Contact Form Submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('contact_submit_btn');
        const messageDiv = document.getElementById('contact_message_div');
        const originalText = submitBtn.textContent;
        
        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'جاري الإرسال...';
        messageDiv.classList.add('hidden');
        
        const formData = new FormData(contactForm);
        
        try {
            const response = await fetch('/contact', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                messageDiv.className = 'p-4 bg-green-50 border border-green-200 rounded-lg text-green-700';
                messageDiv.textContent = data.message || 'تم إرسال رسالتك بنجاح، شكراً لتواصلك معنا!';
                messageDiv.classList.remove('hidden');
                contactForm.reset();
            } else {
                messageDiv.className = 'p-4 bg-red-50 border border-red-200 rounded-lg text-red-700';
                messageDiv.textContent = data.message || 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.';
                messageDiv.classList.remove('hidden');
            }
        } catch (error) {
            messageDiv.className = 'p-4 bg-red-50 border border-red-200 rounded-lg text-red-700';
            messageDiv.textContent = 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.';
            messageDiv.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
}