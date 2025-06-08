document.addEventListener('DOMContentLoaded', () => {
    // Animation avec IntersectionObserver
    const elements = document.querySelectorAll('.findByBudget, .findByBudget h1, .findByBudget input, .finder, .finder input, .finder button, footer .first i, #modal-login');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observerCallBack = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = getAnimation(entry.target);
                observer.unobserve(entry.target); // Évite d'observer à nouveau l'élément après l'animation
            }
        });
    };

    const observer = new IntersectionObserver(observerCallBack, observerOptions);

    elements.forEach(element => {
        observer.observe(element);
    });

    const getAnimation = (element) => {
        if (element.matches('.findByBudget')) return 'showFindByBudget 1s 1s ease forwards';
        if (element.matches('.findByBudget h1')) return 'showFindByBudget 1.5s ease forwards';
        if (element.matches('.findByBudget input')) return 'showFindByBudget 2s ease forwards';
        if (element.matches('.finder')) return 'showFinder 1s ease forwards';
        if (element.matches('.finder input')) return 'showFinder 1.3s ease forwards';
        if (element.matches('.finder button')) return 'showFinder 1.5s ease forwards';
        if (element.matches('footer .first i')) return 'showIcons 1s linear forwards';
        if (element.matches('#modal-login')) return 'showModalLogin 2.5s 1s linear forwards';
    };
    // Gestion des événements pour les dates
    document.querySelectorAll(".dates").forEach(element => {
        element.addEventListener('change', () => {
            document.getElementById("indication").classList.remove("no-flex");
        });
    });

    // Gestion de la modal de connexion
    const modals = document.getElementById('modal-login');

    document.getElementById('modal-login-btn').addEventListener('click', () => {
        if (modals) {
            modals.classList.add('hidder');
        } else {
            console.log("Pas de modal trouvé");
        }
    });
});


// Gestion des événements pour les sliders de budget et de personnes
const range = document.getElementById('range');
const price = document.getElementById('price');
const rangeValue = document.getElementById('range-value');
const rangeValueCdf = document.getElementById('range-value-cdf');
const rangePersonne = document.getElementById('range-personne');
const rangePersonneValue = document.getElementById('range-personne-value');
let tauxDuJour = 2800;


range.addEventListener('input', () => {
    rangeValue.textContent = range.value + "$";
    price.value = range.value;
    rangeValueCdf.textContent = parseInt(range.value) * tauxDuJour + "Fc";
});

price.addEventListener('input', ()=>{
    rangeValue.textContent = price.value + '$';
    range.value = price.value;
    rangeValueCdf.textContent = parseInt(range.value) * tauxDuJour + "Fc";
});

rangePersonne.addEventListener('input', () => {
    rangePersonne.value = rangePersonne.value;
    if (parseInt(rangePersonne.value) == 25) {
        rangePersonneValue.innerHTML = "+" + rangePersonne.value + " personnes";
    } else {
        rangePersonneValue.textContent = parseInt(rangePersonne.value) > 1 ? rangePersonne.value + " personnes" : rangePersonne.value + " personne";
    }
});

//temporairement pour besoin d'essaies ! 
