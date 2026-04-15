import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function getThemeScope() {
    const body = document.body;
    return body?.dataset?.themeScope === 'admin' ? 'admin' : 'public';
}

function getStorageKey() {
    return getThemeScope() === 'admin' ? 'admin-theme' : 'public-theme';
}

function applySavedTheme() {
    const root = document.documentElement;
    const storageKey = getStorageKey();
    const savedTheme = localStorage.getItem(storageKey);
    const prefersDark =
        window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches;

    const useDark = savedTheme ? savedTheme === 'dark' : prefersDark;

    root.classList.toggle('dark', useDark);
}

window.toggleTheme = function () {
    const root = document.documentElement;
    const storageKey = getStorageKey();

    const isDark = root.classList.toggle('dark');
    localStorage.setItem(storageKey, isDark ? 'dark' : 'light');
};

document.addEventListener('DOMContentLoaded', applySavedTheme);


document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.reveal-up');

    if (!('IntersectionObserver' in window)) {
        elements.forEach((el) => el.classList.add('show'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    obs.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.12,
        }
    );

    elements.forEach((el) => observer.observe(el));
});