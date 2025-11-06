// Dark mode toggle logic
function setDarkMode(isDark) {
    if (isDark) {
        document.body.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        // Change icon to moon
        document.getElementById('dark-toggle-icon').innerHTML = `
            <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" stroke="currentColor" stroke-width="2" fill="none"/>
        `;
    } else {
        document.body.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        // Change icon to sun
        document.getElementById('dark-toggle-icon').innerHTML = `
            <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2" fill="none"/>
            <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
        `;
    }
}

// On load, set theme from localStorage or system preference
(function () {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        setDarkMode(true);
    } else {
        setDarkMode(false);
    }
})();

document.getElementById('dark-toggle').addEventListener('click', function () {
    setDarkMode(!document.body.classList.contains('dark'));
});

document.addEventListener('DOMContentLoaded', () => {
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const openBtn = document.getElementById('open-menu-btn');
    const closeBtn = document.getElementById('close-menu-btn');
    const mobileLinks = mobileSidebar.querySelectorAll('a');

    // Toggle mobile sidebar
    openBtn.addEventListener('click', () => mobileSidebar.classList.add('active'));
    closeBtn.addEventListener('click', () => mobileSidebar.classList.remove('active'));

    // Close sidebar when a link is clicked
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileSidebar.classList.remove('active');
        });
    });

    // --- Navbar hide/show on scroll for desktop ---
    const desktopNav = document.getElementById('desktop-nav');
    let lastScrollY = window.scrollY;
    let ticking = false;

    function handleNavbarScroll() {
        const currentScrollY = window.scrollY;
        if (currentScrollY > lastScrollY && currentScrollY > 40) {
            // Scrolling down, hide navbar
            desktopNav.classList.remove('navbar-visible');
            desktopNav.classList.add('navbar-hidden');
        } else {
            // Scrolling up, show navbar
            desktopNav.classList.remove('navbar-hidden');
            desktopNav.classList.add('navbar-visible');
        }
        lastScrollY = currentScrollY;
        ticking = false;
    }

    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(handleNavbarScroll);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
});
