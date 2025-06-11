// disco_bdd.js (or apiJsRestau.js)

document.addEventListener('DOMContentLoaded', function() {
    // --- 1. Global DOM Elements & Constants ---
    const messageDiv = document.getElementById('messageDiv');
    const searchResultsDiv = document.getElementById('resultats');
    const loaderContainer = document.getElementById('loader-container');
    const conversionRate = 2800;
    const API_ENDPOINT = 'http://localhost/kinmenuTest/api/apiRestau.php';

    // --- Budget Search Form Elements ---
    const budgetSearchForm = document.getElementById('searcher');
    const budgetRangeInput = document.getElementById('range');
    const budgetPriceInput = document.getElementById('price');
    const budgetRangeValueDisplay = document.getElementById('range-value');
    const budgetRangeValueCdfDisplay = document.getElementById('range-value-cdf');
    const numberOfPeopleRangeInput = document.getElementById('range-personne');
    const numberOfPeopleValueDisplay = document.getElementById('range-personne-value');
    const isDatableRadios = document.querySelectorAll('input[name="dateOrNot"]');
    

    // --- General Search Form Elements ---
    const generalSearchForm = document.getElementById('searching');
    const restaurantNameInput = document.getElementById('restaurant-name');
    const communeInput = document.getElementById('restaurant-commune');
    const restaurantTypeInput = document.getElementById('restaurant-type');

    // --- 2. Helper Functions (DEFINED HERE FIRST) ---

    function modalShower(){
        const modal = document.getElementById('modalLogin');
        if(modal.classList.contains('no-flex')){
            modal.classList.replace('no-flex', 'flexM');
        }
    
    }

    function displayMessage(message, type = 'info') {
        // Ensure messageDiv exists before trying to manipulate it
        if (messageDiv) {
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
            messageDiv.style.color = (type === 'error') ? 'red' : (type === 'success' ? 'green' : 'black');
        } else {
            console.warn("messageDiv element not found to display message:", message);
        }
    }

    function showLoader() {
        if (loaderContainer) {
            loaderContainer.classList.add('show'); // Use the 'show' class for visibility
        }
    }

    function hideLoader() {
        if (loaderContainer) {
            loaderContainer.classList.remove('show'); // Remove the 'show' class
        }
    }
    function displayResults(restaurants) {
        if (!searchResultsDiv) {
            console.error("searchResultsDiv element not found.");
            return;
        }

        // Initialize with 'no-flex' and remove 'next' (or ensure they're removed on clear)
        searchResultsDiv.innerHTML = ''; // Clear previous results
        searchResultsDiv.classList.add('no-flex'); // Ensure it's hidden or non-flex initially
        searchResultsDiv.classList.remove('flex', 'next'); // Clean up any previous state

        if (restaurants.length === 0) {
            searchResultsDiv.classList.add('flex');
            searchResultsDiv.classList.remove('no-flex');
            searchResultsDiv.innerHTML = '<p class="no-results">Aucun restaurant trouvé pour vos critères.</p>';
            // If no results, keep 'no-flex' and don't add 'flex' or 'next'
            return;
        }

        const ul = document.createElement('ul');
        ul.classList.add('restaurant-list');
        restaurants.forEach(restaurant => {
            // --- Début du bloc de logique pour l'icône ---
            let iconHtml = ""; // Change const to let, and initialize
            const restaurantType = (restaurant.type_restaurant || restaurant.type || '').toLowerCase(); // Use 'restaurant' object, and provide fallback

            if (restaurantType.includes("pizzeria")) { // Use .includes for flexibility, check for "pizzeria"
                iconHtml = '<i class="fa-solid fa-pizza-slice"></i>';
            } else if (restaurantType.includes("restaurant")) { // Use else if for mutually exclusive checks
                iconHtml = '<i class="fa-solid fa-utensils"></i>';
            } else if (restaurantType.includes("fast-food")) { // Use else if
                iconHtml = '<i class="fa-solid fa-burger"></i>';
            } else if (restaurantType.includes('lounge') || restaurantType.includes('bar')) { // Correct typo 'includes'
                iconHtml = '<i class="fa-solid fa-wine-glass-empty"></i>';
            } else if (restaurantType.includes('boulangerie') || restaurantType.includes('patisserie') || restaurantType.includes('vienoiserie')) {
                iconHtml = '<i class="fa-solid fa-bread-slice"></i>'; // Example for patisserie
            } else if (restaurantType.includes('glacier')) {
                iconHtml = '<i class="fa-solid fa-ice-cream"></i>'; // Example for glacier
            }
            // Add more conditions here for other types as needed, or a default icon
            else {
                iconHtml = '<i class="fa-solid fa-utensils"></i>'; // Default icon if no match
            }
            // --- Fin du bloc de logique pour l'icône ---

            // Déterminer la destination du lien en fonction de l'état de connexion
            const linkHref = window.userIsLoggedIn
                ? `../pages/moretest.html?slug=${restaurant.slug}`
                : `../pages/login.html`; // Page de connexion si non connecté

            const li = document.createElement('li');
            li.classList.add('next');
            li.innerHTML = `
                <h3>${restaurant.name || restaurant.nom} ${iconHtml}</h3>
                <p><strong>Commune:</strong> ${restaurant.commune || "Non spécifiée"}</p>
                <p><strong>Type:</strong> ${restaurant.type_restaurant || restaurant.type || "Non spécifié"}</p>
                ${restaurant.rank_type ? `<p><strong>Rang:</strong> ${restaurant.rank_type}</p>` : ''}
                <p><strong>Prix Moyen par personne:</strong> ${restaurant.prix_moyen || restaurant.prix_moyen} USD</p>
                <p>${(restaurant.is_datable === 1 || restaurant.isDatable === "oui") ? '✨ Idéal pour un date ! ✨' : 'Convient à d\'autres occasions mais sûrement pas un date.'}</p>
                <button class="newLink" style="background-color:#db3a00; border:none; color:white;" onclick="${modalShower()}">En savoir plus</button>
                <button class="add-to-fav-btn" data-restaurant-id="${restaurant.id}">Ajouter aux favoris</button>
            `;
            ul.appendChild(li);

        });
        searchResultsDiv.appendChild(ul);

        // Remove 'no-flex' and add 'flex' and 'next' when results are present
        searchResultsDiv.classList.remove('no-flex');
        searchResultsDiv.classList.add('flex');

        document.querySelectorAll('.add-to-fav-btn').forEach(button => {
            button.addEventListener('click', async function() {
                const restaurantId = this.dataset.restaurantId;
                alert(`Fonctionnalité "Ajouter aux favoris" pour le restaurant ID ${restaurantId} à implémenter.`);
            });
        });
    }

    // --- Input Synchronization Functions ---

    function syncBudgetInputs(sourceValue) {
        const numValue = parseFloat(sourceValue);
        if (isNaN(numValue)) {
            budgetRangeInput.value = budgetRangeInput.min;
            budgetPriceInput.value = budgetRangeInput.min;
            updateBudgetDisplay(budgetRangeInput.min);
            return;
        }

        const min = parseFloat(budgetRangeInput.min);
        const max = parseFloat(budgetRangeInput.max);
        let validatedValue = Math.max(min, Math.min(max, numValue));

        if (budgetRangeInput.value != validatedValue) {
            budgetRangeInput.value = validatedValue;
        }
        if (budgetPriceInput.value != validatedValue) {
            budgetPriceInput.value = validatedValue;
        }
        updateBudgetDisplay(validatedValue);
    }

    function updateBudgetDisplay(value) {
        if (budgetRangeValueDisplay && budgetRangeValueCdfDisplay) {
            budgetRangeValueDisplay.textContent = `${value} USD`;
            budgetRangeValueCdfDisplay.textContent = `${(value * conversionRate).toLocaleString('fr-CD', { style: 'currency', currency: 'CDF' })}`;
        }
    }

    function updatePeopleDisplay(value) {
        if (numberOfPeopleValueDisplay) {
            numberOfPeopleValueDisplay.textContent = `${value} personne${value > 1 ? 's' : ''}`;
        }
    }

    // --- API Search Function ---

    async function sendApiSearchRequest(criteria) {
        displayMessage(''); // Clear any previous messages before search
        showLoader(); // Show loader immediately
        const searchStartTime = Date.now();

        try {
            const response = await fetch(API_ENDPOINT, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(criteria)
            });

            if (!response.ok) {
                const errorText = await response.text(); // Get raw error response
                throw new Error(`HTTP error! Status: ${response.status} - ${errorText}`);
            }

            const data = await response.json();

            const elapsed = Date.now() - searchStartTime;
            const remaining = Math.max(0, 2000 - elapsed); // Minimum 2-second loader

            setTimeout(() => {
                hideLoader();

                if (data.success) {
                    displayMessage(data.message, 'success');
                    displayResults(data.restaurants);
                    console.log(data);
                } else {
                    displayMessage(data.message || 'La recherche a échoué.', 'error');
                    console.error('API Error:', data.message);
                }
                document.getElementById('resultats')?.scrollIntoView({ behavior: 'smooth' });
            }, remaining);

        } catch (error) {
            console.error('Erreur de recherche:', error);
            hideLoader();
            displayMessage('Erreur lors de la connexion au serveur. Veuillez réessayer. Détails: ' + error.message, 'error');
            document.getElementById('resultats')?.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // --- 3. Initial Setup for Inputs ---

    if (budgetRangeInput && budgetPriceInput) {
        budgetRangeInput.addEventListener('input', function() {
            syncBudgetInputs(this.value);
        });
        budgetPriceInput.addEventListener('input', function() {
            syncBudgetInputs(this.value);
        });
        syncBudgetInputs(budgetRangeInput.value);
    }

    if (numberOfPeopleRangeInput && numberOfPeopleValueDisplay) {
        numberOfPeopleRangeInput.addEventListener('input', function() {
            updatePeopleDisplay(this.value);
        });
        updatePeopleDisplay(numberOfPeopleRangeInput.value);
    }


    // --- 4. Form Submission Handlers ---

    if (budgetSearchForm) {
        budgetSearchForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const isDateValue = document.querySelector('input[name="dateOrNot"]:checked')?.value;
            const nbrePersonne = parseInt(numberOfPeopleRangeInput.value) || 1;
            const totalBudget = parseFloat(budgetPriceInput.value) || 0;

            const budgetPerPersonCalculated = (totalBudget > 0 && nbrePersonne > 0) ? (totalBudget / nbrePersonne) : 0;

            if (totalBudget <= 0 || nbrePersonne <= 0) {
                displayMessage('Veuillez entrer un budget total et un nombre de personnes valides.', 'error');
                return;
            }

            const criteria = {
                budgetInput: budgetPerPersonCalculated,
                numberOfPeople: nbrePersonne,
                isDatable: isDateValue === 'oui',
                name: null,
                commune: null,
                restaurantType: null,
                rankType: null
            };

            sendApiSearchRequest(criteria);
        });
    }


    if (generalSearchForm) {
        generalSearchForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const criteria = {
                name: restaurantNameInput.value.trim(),
                commune: communeInput.value.trim(),
                restaurantType: restaurantTypeInput.value.trim(),
                rankType: null,
                budgetInput: null,
                numberOfPeople: null,
                isDatable: false
            };

            if (!criteria.name && !criteria.commune && !criteria.restaurantType) {
                displayMessage('Veuillez entrer au moins un critère de recherche (Nom, Commune, Type).', 'error');
                return;
            }

            sendApiSearchRequest(criteria);
        });
    }

    // --- 5. Best Of Slider Code (if still using local 'restau' array) ---
    // If your bestOf data is also from DB, you'd fetch it similarly to the search.
    // For now, retaining local `restau` array for this part.
    // Ensure `Restaurant` class is defined before `restau` array.
    class Restaurant {
        constructor(nom, adresse, deuxiemeAdresse, type, prixMoyen, note, commune, isDatable, slug) {
            this.nom = nom;
            this.adresse = adresse;
            this.deuxiemeAdresse = deuxiemeAdresse;
            this.type = type;
            this.prixMoyen = prixMoyen;
            this.note = note;
            this.commune = commune;
            this.isDatable = isDatable;
            this.slug = slug;
        }
    }

    const restau = [
        new Restaurant("Pizza-inn", "24", "Bandalungwa", "Pizzeria", 20, "4", "Gombe", "non", "pizza-inn"),
        new Restaurant("Kin Tacos", "24", "Assanef", "Fast-food", 15, "3.5", "Kintambo", "non", "kin-tacos"),
        new Restaurant("Burger guys", "GB", "", "Fast-food", 15, "3", "Gombe", "non", "burger-guys"),
        new Restaurant("Délifrance", "Blvrd 30 juin", "Defacto", "Boulangerie, Patisserie & vienoiserie", 17, "4", "Gombe", "oui", "delifrance"),
        new Restaurant('Opoeta', "Kintambo", "cimetière Gombe", "Pizeria & restaurant", 20, "3", "Kintambo", "oui", "opoeta"),
        new Restaurant("KFC", "24novembre", "", "Fast-Food", 15, "3", "Gombe", "non", "kfc"),
        new Restaurant("Chocolate Serayi", "Blvrd 30juin", "Socimat", "Glacier", 12, "4", "Gombe", "oui", "chocolate"),
        new Restaurant("Malamu", "24", "", "Restaurant", 20, "4", "Gombe", "oui", "malamu"),
        new Restaurant("3z", "Gombe", "", "Restaurant", 35, "4.5", "Gombe", "oui", "3z"),
        new Restaurant("Villa Tricana", "Gombe", "", "Restaurant", 20, "4", "Gombe", "oui", "villa"),
        new Restaurant("Palms", "Mt Fleury", "", "Restaurant", 20, "3", "Kintambo", "oui", "palms"),
        new Restaurant("Donishka", "Macampagne", "UPN", "Fast-food", 15, "3", "Ngaliema", "oui", "donishka"),
        new Restaurant("Chez Momo", "upn-marine", "", "Terasse-Restau", 12, "3", "Ngaliema", "oui", "chezmomo"),
        new Restaurant("S&K restaurant", "Rte Matadi/ex-peloustore)", "", "Fast-Food", 12, "3", "Ngaliema", "non", "sk"),
        new Restaurant("Fat Burger", "Gb", "Blvrd du 30 juin", "Fast-food", 25, "3", "Gombe", "oui", "fatburger"),
        new Restaurant("110 street", "Blvrd 30juin", "", "Fast-food", 18, "4", "Gombe", "oui", "street"),
        new Restaurant("One Zoo", "1er shopping Mall", "", "boisson", 7, "4.5", "Gombe", "oui", "oneZoo"),
        new Restaurant("K-Lounge", "Blvrd 30 juin", "", "Lounge", 14, "4", "Gombe", "oui", "klounge"),
        new Restaurant("Metro Bar", "Bandal", "Blvrd", "Bar", 14, "4", "Bandalungwa", "non", "metrobar"),
        new Restaurant("Pyma Bar", "Bandal", "", "Bar", 20, "4", "Bandalungwa", "oui", "pymabar"),
        new Restaurant("Eric Kayser", "ville", "limete", "Boulangerie,Patisserie & vienoiserie", 12, "4.5", "Gombe", "oui", "erickayser"),
        new Restaurant("Firenze", "Huilerie (ref-INRB)", "", "Boulangerie, Patisserie & vienoiserie", 12, "4", "Gombe", "oui", "firenze"),
        new Restaurant("Chez Paul", "Gombe", "", "Boulangerie, Patisserie & vienoiserie", 20, "4", "Gombe", "oui", "chezpaul"),
        new Restaurant("Wabi sabi", "Gombe", "", "Restaurant", 30, "4.5", "Gombe", "oui", "wabisabi"),
        new Restaurant("Celia", "Shopping Mall", "", "Restaurant", 20, "4", "Gombe", "oui", "celia"),
        new Restaurant("Sicilia", "Gombe", "", "Restaurant", 40, "3", "Gombe", "oui", "sicilia"),
        new Restaurant("110 Street", "Gombe", "", "Fast-food", 17, "4", "Gombe", "oui", "110street" ),
        new Restaurant("Makusa", "06, Av Bobila", "" ,"Restaurant", 40,"5", "Ngaliema", "oui", "makusa"), // Slug was misplaced, fixed here
        new Restaurant("Big Bite", "Avenue du 24 Novembre" ,"", "Fast-Food", 12, "2.5", "Lingwala", "non", "bigbite"),
        new Restaurant("Tandoor", "Modern Paradise 8225, Av. Kabasele Tshamala", "", "Restaurant", 25, "4", "Kinshasa", "oui" ,"tandoor"),
        new Restaurant("Cold Stone", " 8 Av. Du Port, Kinshasa", "Gombe", "Fast-food", 15, "3", "Ngaliema","oui","cold-stone"),
        new Restaurant("Royal", "Blvrd du 30 juin", "", "Fast-food", 15, "3", "Gombe", "oui", "royal"),
        new Restaurant("Kiriku", "Av. Prince De Liege En Face Isipa Shaumba", "UPN, Ngaliema", "Fast-food" ,17, "2", "Ngaliema", "oui", "kiriku"),
        new Restaurant("Seray", "Immeuble 1113, Bd Du 30 Juin, Kinshasa", "", "Restaurant", 50, "5", "Gombe", "oui", "seray"),
        new Restaurant("Phoenicia", "ISCC, 7 eme, Av. Du 24 Novembre", "", "Restaurant", 50, "5", "Gombe", "oui", "phoenicia")
    ];


    const bestOfContainer = document.getElementById('best-of-container');
    const bestOf = [
        {
            nom: "Découvrez les meilleurs restaurants",
            image: "#db3a00", // This looks like a color, not an image path
            note: 4.5,
            adresse: "",
            link: "",
            linkColors: "transparent",
            color: "white",
            distance: 2.5,
            prix: ""
        }
    ];

    let currentIndex = 0;

    const updateSlider = () => {
        if (!bestOfContainer || bestOf.length === 0) {
            return;
        }

        const currentBestOf = bestOf[currentIndex];

        bestOfContainer.innerHTML = `
            <div class="slides">
                <h1 class="title">${currentBestOf.nom}</h1>
                <p class="description">${currentBestOf.prix || ''}</p>
                <p class="description">${currentBestOf.adresse || ''}</p>
                <a class="links" id="link" href="./login.php">${currentBestOf.link || ''}</a>
            </div>
        `;

        const links = document.getElementById("link");

        if (currentBestOf.image.startsWith('#')) {
            bestOfContainer.style.background = currentBestOf.image;
            bestOfContainer.style.backgroundImage = "none";
        } else {
            bestOfContainer.style.background = "none";
            bestOfContainer.style.backgroundImage = `url(${currentBestOf.image})`;
            bestOfContainer.style.backgroundSize = "cover";
            bestOfContainer.style.backgroundPosition = "center";
            bestOfContainer.style.backgroundRepeat = "no-repeat";
        }

        bestOfContainer.style.color = currentBestOf.color;
        if (links) {
            links.style.backgroundColor = currentBestOf.linkColors;
            links.style.border = currentBestOf.border || "none";
        }

        currentIndex = (currentIndex + 1) % bestOf.length;
    };

    restau.forEach(restaurant => {
        bestOf.push({
            nom: restaurant.nom,
            prix: `${restaurant.prixMoyen} USD`,
            commune: restaurant.commune,
            adresse: restaurant.adresse || "Adresse inconnue",
            link: "Voir plus",
            linkColors: "orange",
            color: "#223330",
            image: restaurant.image || '#db3a00'
        });
    });

    if (bestOfContainer && bestOf.length > 0) {
        updateSlider();
        setInterval(updateSlider, 8000);
    }
});

