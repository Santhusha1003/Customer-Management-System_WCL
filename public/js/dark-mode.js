(function () {
    const storageKey = 'cmsThemePreference';
    const lightTheme = 'light';
    const darkTheme = 'dark';

    function isPageRefresh() {
        const navigationEntry = performance.getEntriesByType('navigation')[0];

        return navigationEntry?.type === 'reload';
    }

    function getStoredTheme() {
        try {
            return sessionStorage.getItem(storageKey);
        } catch (error) {
            return null;
        }
    }

    function storeTheme(theme) {
        try {
            sessionStorage.setItem(storageKey, theme);
        } catch (error) {
            // Session storage can be unavailable in private browsing modes.
        }
    }

    function clearStoredTheme() {
        try {
            sessionStorage.removeItem(storageKey);
        } catch (error) {
            // Session storage can be unavailable in private browsing modes.
        }
    }

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

    if (isPageRefresh()) {
        clearStoredTheme();
    }

    applyTheme(getStoredTheme() || lightTheme);

    document.addEventListener('DOMContentLoaded', () => {
        updateToggle(document.documentElement.getAttribute('data-theme') === darkTheme);

        document.getElementById('themeToggle')?.addEventListener('click', () => {
            const nextTheme = document.documentElement.getAttribute('data-theme') === darkTheme ? 'light' : darkTheme;

            applyTheme(nextTheme);
            storeTheme(nextTheme);
        });
    });
})();
