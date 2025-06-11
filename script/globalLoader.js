window.addEventListener('load', function() {
    const loader = document.getElementById('global-page-loader');
    if (loader) {
        loader.style.opacity = '0';
        loader.addEventListener('transitionend', function() {
            loader.style.display = 'none';
        }, { once: true });
    }
});