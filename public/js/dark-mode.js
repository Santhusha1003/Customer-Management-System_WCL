(function () {
    const lightTheme = 'light';
    const darkTheme = 'dark';

    function applyTheme(theme) {
        const isDark = theme === darkTheme;

        if (isDark) {
            document.documentElement.setAttribute('data-theme', darkTheme);
        } else {
            document.documentElement.removeAttribute('data-theme');
        }

        updateToggle(isDark);
    }

    function updateToggle(isDark) {
        const toggle = document.getElementById('themeToggle');
        const icon = document.getElementById('themeToggleIcon');

        if (!toggle || !icon) {
            return;
        }

        toggle.setAttribute('aria-pressed', String(isDark));
        toggle.setAttribute('aria-label', isDark ? 'Enable light mode' : 'Enable dark mode');
        icon.className = isDark ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
    }

    applyTheme(lightTheme);

    document.addEventListener('DOMContentLoaded', () => {
        updateToggle(document.documentElement.getAttribute('data-theme') === darkTheme);

        document.getElementById('themeToggle')?.addEventListener('click', () => {
            const nextTheme = document.documentElement.getAttribute('data-theme') === darkTheme ? 'light' : darkTheme;

            applyTheme(nextTheme);
        });
    });
})();
