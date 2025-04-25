document.addEventListener('DOMContentLoaded', () => {
    const themeBtn = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('theme-icon-light');
    const moonIcon = document.getElementById('theme-icon-dark');

    function syncIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        sunIcon.style.display = isDark ? 'block' : 'none';
        moonIcon.style.display = isDark ? 'none' : 'block';
    }

    // Imposta il tema in base al localStorage o preferenze sistema
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    syncIcons();

    // Toggle del tema al click
    themeBtn.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        const isNowDark = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isNowDark ? 'dark' : 'light');
        syncIcons();
    });

    // Funzionalità del menu burger
    const menuToggleBtn = document.getElementById('menu-toggle');
    const menuDropdown = document.getElementById('menu-dropdown');

    menuToggleBtn.addEventListener('click', function () {
        const isVisible = !menuDropdown.classList.contains('hidden');
        menuDropdown.classList.toggle('hidden');
        menuDropdown.style.opacity = isVisible ? '0' : '1';
        menuDropdown.style.pointerEvents = isVisible ? 'none' : 'auto';
    });

    // Chiudi il menu se clicchi fuori
    document.addEventListener('click', function (event) {
        if (
            !menuToggleBtn.contains(event.target) &&
            !menuDropdown.contains(event.target)
        ) {
            menuDropdown.classList.add('hidden');
            menuDropdown.style.opacity = '0';
            menuDropdown.style.pointerEvents = 'none';
        }
    });
});
