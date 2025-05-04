document.addEventListener("DOMContentLoaded", function() {
    const hamburgerBtn = document.getElementById("hamburgerBtn");
    const menuBar = document.getElementById("menu-bar");

    hamburgerBtn.addEventListener("click", function() {
        if (menuBar.classList.contains("desactivate")) {
            menuBar.classList.remove("desactivate");
            menuBar.classList.add("activate");
        } else {
            menuBar.classList.remove("activate");
            menuBar.classList.add("desactivate");
        }
    });

    // Gestion du formulaire
    document.getElementById("search-form").addEventListener("submit", function(event) {
        event.preventDefault();

        let budget = document.getElementById("budget").value;
        let personnes = document.getElementById("personnes").value;
        let date = document.getElementById("date").value;
        let commune = document.getElementById("commune").value;
        let cuisine = document.getElementById("cuisine").value;

        let resultsList = document.getElementById("results-list");
        resultsList.innerHTML = `<li>🔍 Recherche en cours...</li>`;

        setTimeout(() => {
            resultsList.innerHTML = `<li>🍽️ Résultats pour un budget de <b>${budget}</b> avec <b>${personnes}</b> personnes...</li>`;
        }, 1000);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".slider");
    let index = 0;

    function nextSlide() {
        index++;
        if (index >= 4) { // 4 images
            index = 0;
        }
        updateSlide();
    }

    function updateSlide() {
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(nextSlide, 3000); // Change d’image toutes les 3 secondes
});
