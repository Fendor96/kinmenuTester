
window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    const main = document.querySelector('body');

    // Cache le loader
    loader.style.opacity = '0';

    setTimeout(function() {
        loader.style.display = 'none';

        // Affiche le main avec animation
        main.style.opacity = '1';
        main.style.transform = 'translateY(0)';
    }, 500);
});
