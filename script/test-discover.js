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

    createSlug() {
        return this.nom
            .toLowerCase().normalize("NFD").replace(/[^a-z0-9\s-]/g, "").trim().replace(/\s+/g, "-")
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
    new Restaurant("Makusa", "06, Av Bobila", "" ,"Restaurant", 40,"5", "Ngaliema", "oui", "Ngaliema", "makusa"),
    new Restaurant("Big Bite", "Avenue du 24 Novembre" ,"", "Fast-Food", 12, "2.5", "Lingwala", "non", "bigbite"),
    new Restaurant("Tandoor", "Modern Paradise 8225, Av. Kabasele Tshamala", "", "Restaurant", 25, "4", "Kinshasa", "oui" ,"tandoor"),
    new Restaurant("Cold Stone", " 8 Av. Du Port, Kinshasa", "Gombe", "Fast-food", 15, "3", "Ngaliema","oui","cold-stone"),
    new Restaurant("Royal", "Blvrd du 30 juin", "", "Fast-food", 15, "3", "Gombe", "oui", "royal"),
    new Restaurant("Kiriku", "Av. Prince De Liege En Face Isipa Shaumba", "UPN, Ngaliema", "Fast-food" ,17, "2", "Ngaliema", "oui", "kiriku"),
    new Restaurant("Seray", "Immeuble 1113, Bd Du 30 Juin, Kinshasa", "", "Restaurant", 50, "5", "Gombe", "oui", "seray"),
    new Restaurant("Phoenicia", "ISCC, 7 eme, Av. Du 24 Novembre", "", "Restaurant", 50, "5", "Gombe", "oui", "phoenicia")
];

const searchName = document.getElementById("resultats");

// Restaurant class and data remains the same...

// Loader functions
const showLoader = () => {
    const loader = document.getElementById('loader-container');
    if (loader) {
        loader.style.display = "flex"; // Changed from visibility to display
        loader.style.visibility = "visible";
    }
};

const hideLoader = () => {
    const loader = document.getElementById('loader-container');
    if (loader) {
        loader.style.display = "none";
    }
};

// Make search functions return Promises
const searchByBudget = async (max, min, nbrePersonne, isDatable) => {
    return new Promise((resolve) => {
        setTimeout(() => {
            searchName.innerHTML = '';
            if(nbrePersonne){
                min = parseInt(min/nbrePersonne);
            }

            let results = [];

            if (isDatable == "No" || !isDatable){
                restau.forEach(restaurant => {
                    if (restaurant.prixMoyen <= max) {
                        results.push(restaurant);
                    }
                });

                if (results.length === 0) {
                    searchName.innerHTML = '<p>Aucun restaurant trouvé dans cette plage de prix. <br> Avec 10$ de plus vous pourrez trouver: </p>';
                    max = max + 10;
                    const resultsB = [];
                    restau.forEach(restaurant =>{
                        if(restaurant.prixMoyen <= max){
                            resultsB.push(restaurant);
                        }
                    })

                    resultsB.forEach(restaurant => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                            <h2>${restaurant.nom}</h2>
                            <p>Commune : ${restaurant.commune || "Nan"}</p>
                            <p>Type de cuisine : ${restaurant.type}</p>
                            <p>Prix moyen : ${restaurant.prixMoyen} USD/personne</p>
                            <a class="newLink" href="${`../pages/moretest.html?slug=${restaurant.slug}`}">En savoir plus</a>
                        `;
                        div.classList.add('next');
                        searchName.appendChild(div);
                        searchName.classList.replace('no-flex', 'flex');
                    });
                    resolve();
                    return;
                }

                results.forEach(restaurant => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <h2>${restaurant.nom}</h2>
                        <p>Commune : ${restaurant.commune || "Nan"}</p>
                        <p>Type de cuisine : ${restaurant.type}</p>
                        <p>Prix moyen : ${restaurant.prixMoyen} USD/personne</p>
                        <a class="newLink" href="${`../pages/moretest.html?slug=${restaurant.slug}`}">En savoir plus</a>
                    `;
                    div.classList.add('next');
                    searchName.appendChild(div);
                    searchName.classList.replace('no-flex', 'flex');
                });
                resolve();
            } else {
                restau.forEach(restaurant => {
                    if (restaurant.prixMoyen >= min && restaurant.prixMoyen <= max && restaurant.isDatable == "oui") {
                        results.push(restaurant);
                    }
                });

                if (results.length === 0) {
                    searchName.innerHTML = '<p>Aucun restaurant trouvé dans cette plage de prix.</p>';
                    resolve();
                    return;
                }

                results.forEach(restaurant => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <h2>${restaurant.nom}</h2>
                        <p>Commune : ${restaurant.commune || "Nan"}</p>
                        <p>Type de cuisine : ${restaurant.type}</p>
                        <p>Prix moyen : ${restaurant.prixMoyen} USD/personne</p>
                        <a class="newLink" href="${`../pages/moretest.html?slug=${restaurant.slug}`}">En savoir plus</a>
                    `;
                    div.classList.add('next');
                    searchName.appendChild(div);
                    searchName.classList.replace('no-flex', 'flex');
                });
                resolve();
            }
        }, 100); // Small delay to allow UI to update
    });
};

const searching = async (name, township, typeCuisine) => {
    return new Promise((resolve) => {
        setTimeout(() => {
            searchName.innerHTML = '';
            console.log(name, township, typeCuisine);
            
            let results = [];

            if (name) {
                searchByName(name);
                resolve();
                return;
            }

            if (township && typeCuisine) {
                results = restau.filter(restaurant => 
                    restaurant.commune.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"") === township.toLowerCase().replace(/[^a-zA-Z0-9 ]/g,"").normalize("NFD") && 
                    restaurant.type.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"") === typeCuisine.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"")
                );
            } else if (township) {
                results = restau.filter(restaurant => 
                    restaurant.commune.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"") === township.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"")
                );
            } else if (typeCuisine) {
                results = restau.filter(restaurant => 
                    restaurant.type.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"") === typeCuisine.toLowerCase().normalize("NFD").replace(/[^a-zA-Z0-9 ]/g,"")
                );
            }

            if (results.length === 0) {
                searchName.classList.replace('no-flex', 'flex');
                searchName.innerHTML = '<p>Aucun restaurant trouvé avec ces critères.</p>';
                resolve();
                return;
            }

            results.forEach(restaurant => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <h2>${restaurant.nom}</h2>
                    <p>Commune : ${restaurant.commune || "Nan"}</p>
                    <p>Type de cuisine : ${restaurant.type}</p>
                    <p>Prix moyen : ${restaurant.prixMoyen} USD/personne</p>
                    <a class="newLink" href="${`../pages/moretest.html?slug=${restaurant.slug}`}">En savoir plus</a>
                `;
                div.classList.add('next');
                searchName.appendChild(div);
                searchName.classList.replace('no-flex', 'flex');
            });
            resolve();
        }, 100); // Small delay to allow UI to update
    });
};

// Form handlers with proper async/await
document.getElementById("searcher")?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    try {
        // Show loader immediately
        showLoader();
        
        // Get form values
        const isDate = document.querySelector('input[name="dateOrNot"]:checked')?.value || "No";
        const nbrePersonne = parseInt(document.getElementById('range-personne')?.value) || 1;
        const min = parseInt(document.getElementById('range')?.value) || 0;
        const max = (min / nbrePersonne) + 5;
        
        // Minimum 2 seconds loader display
        const searchStartTime = Date.now();
        
        // Perform search
        await searchByBudget(max, min, nbrePersonne, isDate);
        
        // Calculate remaining time to reach 2 seconds
        const elapsed = Date.now() - searchStartTime;
        const remaining = Math.max(0, 2000 - elapsed);
        
        // Hide loader after remaining time
        setTimeout(hideLoader, remaining);
    } catch (error) {
        console.error("Search error:", error);
        hideLoader();
    }
});

document.getElementById('searching')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    try {
        // Show loader immediately
        showLoader();
        
        // Get form values
        const commune = document.getElementById('restaurant-commune')?.value || '';
        const type = document.getElementById('restaurant-type')?.value || '';
        const name = document.getElementById('restaurant-name')?.value || '';
        
        // Minimum 2 seconds loader display
        const searchStartTime = Date.now();
        
        // Perform search
        await searching(name, commune, type);
        
        // Calculate remaining time to reach 2 seconds
        const elapsed = Date.now() - searchStartTime;
        const remaining = Math.max(0, 2000 - elapsed);
        
        // Hide loader after remaining time
        setTimeout(hideLoader, remaining);
    } catch (error) {
        console.error("Search error:", error);
        hideLoader();
    }
});

// Best of slider code remains the same...
const bestOfContainer = document.getElementById('best-of-container');
const bestOf = [
    {
        nom: "Découvrez les meilleures restaurants",
        image: "#db3a00",
        note: 4.5,
        adresse: "",
        link: "",
        linkColors: "transparent",
        color: "white",
        distance: 2.5
    }
];
const currentIndex = 0;


const updateSlider = (bestOf, currentIndex) => {
        bestOfContainer.innerHTML = `
            <div class="slides">
                <h1 class="title">${bestOf[currentIndex].nom}</h1>
                <p class="description">${bestOf[currentIndex].prix}</p>
                <p class="description">${bestOf[currentIndex].adresse}</p>
                <a class="links" id="link" href="./login.html">${bestOf[currentIndex].link}</a>
            </div>
        `;

        const links = document.getElementById("link");

        // Styles
        bestOfContainer.style.background = bestOf[currentIndex].image;
        bestOfContainer.style.backgroundImage = `url(${bestOf[currentIndex].image})`;
        bestOfContainer.style.backgroundSize = "cover";
        bestOfContainer.style.backgroundPosition = "center";
        bestOfContainer.style.backgroundRepeat = "no-repeat";
        bestOfContainer.style.color = bestOf[currentIndex].color;
        links.style.backgroundColor = bestOf[currentIndex].linkColors;
        links.style.border = bestOf[currentIndex].border || "none";

        currentIndex = (currentIndex + 1) % bestOf.length;

        console.log(bestOf[currentIndex].nom);
};




    restau.forEach(restaurant =>{
        bestOf.push({
            nom: restaurant.nom,
            prix: restaurant.prix,
            commune: restaurant.commune,
            adresse: restaurant.adresse || "Adresse inconnue",
            link: "Voir plus",
            linkColors: "orange",
            color: "#223330",

        });

        updateSlider(bestOf, currentIndex);
        setInterval(updateSlider, 8000);
    });



