const carte = document.getElementById('carte');

const changeCarteBg =()=>{
    const listOfColours = ['223330', 'db3a00'];
    const indexOf = Math.floor(Math.random()*listOfColours.length);
    carte.style.backgroundColor = `#${listOfColours[indexOf]}`;
};

setInterval(changeCarteBg, 5000);

document.addEventListener('DOMContentLoaded', function(){
    let count = 0;
    let i = 0;
    const pS = document.querySelectorAll('.p');

    while (count < pS.length){
        if(i%2 == 0){
            pS[i].style.border = "2px dashed snow";
            pS[i].style.color = "White";
        }else{
            pS[i].style.border = "1px dashed snow";
        }

        i++;
        count++;
    }
});

const imagesTab = [];



const changeBg = () => {
    let indexOf = Math.floor(Math.random()*imagesTab.length);
    document.getElementById('img-restau').style.backgroundImage=`url(${imagesTab[indexOf]})`;
}

setInterval(changeBg, 5000);


// Fonction pour récupérer les données du restaurant et les images
async function fetchRestaurantData(slug) {
    try {
        const response = await fetch(`http://localhost/Kin-menu/configuration/more.php?slug=${slug}`);
        
        // Vérifier si la réponse est valide
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }

        const data = await response.json();
        
        if (!data || data.error) {
            console.error('Erreur dans la réponse du serveur :', data.error || 'Données invalides');
            return;
        }

        console.log(data);

        // Vérifier si data.restaurant existe
        if (!data.restaurant) {
            console.error('Données du restaurant manquantes');
            return;
        }

        // Mise à jour des éléments du DOM
        document.getElementById('nom').textContent = data.restaurant.restau_name || 'Nom inconnu';
        document.getElementById('prix').textContent = `${data.restaurant.prix_moyen || '?'}$/personne`;
        document.getElementById('type').textContent = `Type: ${data.restaurant.type_cuisine || 'Inconnu'}`;
        document.getElementById('Addresse').textContent = `Adresse: ${data.restaurant.adresse || 'Non spécifiée'}`;
        document.getElementById('Note').textContent = `Note : ${data.restaurant.note_moyenne || '0'} / 5`;
        document.getElementById('date').textContent = `Pour un date ? : ${data.restaurant.Isdatable ? 'Oui' : 'Non'}`;
        document.getElementById('menu').href = `htpp://localhost/Kin-menu/${data.menus.menu_path}` || '#';
        document.getElementById('reservez').href = `${data.restaurant.links}` || '#';
        document.getElementById('restau-name').textContent = data.restaurant.restau_name || 'Nom inconnu';
        document.getElementById('prices').innerHTML = `
            <div id="left">
                <p class="p">Prix Moyen: </p>
                <p class="p">Prix Pour deux: </p>
                <p class="p">Plats double</p>
                <p class="p"> Plats à 5+</p>
            </div>

            <div id="right">
                <p class="p">${data.restaurant.prix_moyen || "NAN"}</p>
                <p class="p">${parseInt(data.restaurant.prix_moyen)*2 || "NAN"}</p>
                <p class="p">${data.restaurant.prix_moyen || "NAN"}</p>
                <p class="p">${data.restaurant.prix_moyen || "NAN"}</p>
            </div>
        `;

        // Gestion des images
        const imgRestau = document.getElementById('img-restau');
        if (data.images && data.images.length > 0) {
            imgRestau.style.backgroundImage = `url('http://localhost/Kin-menu/${data.images[0].chemin}')`;
        } else {
            imgRestau.style.backgroundImage = "url('../Styles/assets/Free Online Courses & Certification.gif')"; // Image par défaut
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données :', error);
    }
}

// Récupérer le slug depuis l'URL
const urlParams = new URLSearchParams(window.location.search);
const slug = urlParams.get('slug');

// Charger les données du restaurant
if (slug) {
    fetchRestaurantData(slug);
} else {
    console.error('Aucun slug spécifié dans l\'URL');
}

const now = new Date();

const dateHeure = now.getFullYear() + "-" + String(now.getMonth() + 1).padStart(2,'0')+ '-' + String(now.getDate()).padStart(2,'0')+ ' ' + String(now.getHours()).padStart(2,'0')+ ':' +  String(now.getMinutes()).padStart(2,'0')+ ':' + String(now.getSeconds()).padStart(2,'0');  
document.getElementById('date-heure').value = dateHeure;

document.getElementById('noteGiven').addEventListener('change', function(){
    document.getElementById('values').textContent = document.getElementById('noteGiven').value;
});

document.getElementById('form').addEventListener('submit', function(e){
    e.preventDefault();

    document.getElementById('giveNote').classList.add('hide');
    document.getElementById('thanks').classList.replace ('hide', 'show');
})


