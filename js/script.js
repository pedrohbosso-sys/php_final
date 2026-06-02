(function () {
    const html = document.documentElement;
    const btn = document.getElementById('themeToggle');
    const logo = document.getElementById('siteLogo');

    const savedTheme =
        localStorage.getItem('proleague-theme') || 'dark';

    html.setAttribute('data-theme', savedTheme);

    if (logo) {
        logo.src =
            savedTheme === 'light'
                ? '/img/logobranco.png'
                : '/img/logo.png';
    }

    if (btn) {
        btn.addEventListener('click', () => {
            const currentTheme =
                html.getAttribute('data-theme');

            const nextTheme =
                currentTheme === 'dark'
                    ? 'light'
                    : 'dark';

            html.setAttribute('data-theme', nextTheme);

            localStorage.setItem(
                'proleague-theme',
                nextTheme
            );

            if (logo) {
                logo.src =
                    nextTheme === 'light'
                        ? '/img/logoBranco.png'
                        : '/img/logo.png';
            }
        });
    }
})();