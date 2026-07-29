document.addEventListener('DOMContentLoaded', () => {
    const splashScreen = document.getElementById('cmsSplashScreen');

    if (!splashScreen) {
        return;
    }

    const storageKey = 'cmsSplashShown';
    const navigationEntry = performance.getEntriesByType('navigation')[0];
    const isReload = navigationEntry?.type === 'reload';
    const shouldShowSplash = isReload || sessionStorage.getItem(storageKey) !== 'true';

    if (!shouldShowSplash) {
        splashScreen.remove();
        return;
    }

    document.body.classList.add('cms-splash-lock');
    sessionStorage.setItem(storageKey, 'true');

    window.setTimeout(() => {
        splashScreen.classList.add('is-hidden');
        document.body.classList.remove('cms-splash-lock');

        window.setTimeout(() => {
            splashScreen.remove();
        }, 400);
    }, 3000);
});
