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

document.addEventListener('DOMContentLoaded', async () => {
    const bestOfContainer = document.getElementById('best-of-container');
    let currentIndex = 0;

    // Fonction pour récupérer les restaurants depuis le backend
    const fetchRestaurants = async () => {
        try {
            const response = await fetch('http://localhost/Kin-menu/configuration/bestRestau.php');
            const data = await response.json();
            console.log(data)
            
            if (data.error) {
                console.error("Erreur:", data.error);
                return;
            }


            // Ajouter les données récupérées à `bestOf`
            data.forEach(restaurant => {
                bestOf.push({
                    nom: restaurant.restau_name,
                    prix: restaurant.prix_moyen || "undefinied",
                    image: restaurant.image || "../Styles/assets/default.jpg", // Image par défaut si vide
                    note: restaurant.note_moyenne || 4.5,
                    adresse: restaurant.adresse || "Adresse inconnue",
                    link: "Voir plus",
                    linkColors: "orange",
                    color: "#223330",
                    distance: restaurant.latitude || 2.5
                });
            });

            // Lancer le slider après récupération des données
            updateSliders();
            setInterval(updateSliders, 8000);
        } catch (error) {
            console.error("Erreur de requête:", error);
        }
    };

    // Fonction pour mettre à jour l'affichage du slider
    const updateSliders = () => {
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
    };

    // Charger les restaurants dynamiquement
    await fetchRestaurants();
});
