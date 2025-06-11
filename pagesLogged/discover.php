
<?php 
    session_start();
    if(!isset($_SESSION_['username'])) {
        header('Location: ../Pages/login.php');
        exit();
    }

?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--Meta-->
        <meta charset="UTF-8">
        <meta name="author" content="Axel Nodier">
        <meta name="keywords" content="menu, restaurant, kinshasa restaurant, reservation">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!--Fonts and Icons-->
        <link rel="icon" href="../Styles/assets/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../Styles/globalLoader.css">
        <link rel="stylesheet" href="../Styles/discover.css">
        <link rel="stylesheet" href="../Styles/header.css">
    
        <!--Title-->
        <title>Découvrir-Kin Menu</title>
    </head>

<body>
    <div id="global-page-loader">
        <div class="loader-content">
            <div class="spinner-kinmenu"></div>
            <div class="loader-text">KIN <br> MENU</div>
        </div>
    </div>
    <!-- Header -->
    <header>
        <div id="logo">KIN <br> MENU</div>

        <nav class="nav-links">
            <ul>
                <li><a href="./home.php" class="active">Mon dashboard</a></li>
                <li><a href="./discover.php">Rechercher</a></li>
                <li><a href="./favoris.php">Mes favoris</a></li>
                <li><a href="./account.php">Mon compte</a></li>
            </ul>
            <div class="auth-links">
                <a href="./deconnexion.php">Se deconecter</a>
            </div>
        </nav>

        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
        <ul class="mobile-links">
            <li><a href="./home.php" class="active">Accueil</a></li>
            <li><a href="./discover.php">Rechercher <i class="fa-solid fa-search"></i></a></li>
            <li><a href="./favoris.php">Mes Favoris <i class="fa-solid fa-heart"></i></a></li>
            <li><a href="./account.php">Mon compte <i class="fa-solid fa-account"></i></a></li>
            <li><a href=".deconnexion.php">Deconnexion <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>

    <div id="loader-container">
        <div id="loading-spinner"></div>
    </div>


    <section class="findByBudget" id="founded">
        <div id="messageDiv" style="color:red !important;"></div>
        <h1>Trouve quoi faire à Kin en fonction de ton budget </h1>
        <form id="searcher">
            <div class="inputSection">
                <label for="range">Ton Budget</label><br>
                <svg class="hand" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M128 40c0-22.1 17.9-40 40-40s40 17.9 40 40l0 148.2c8.5-7.6 19.7-12.2 32-12.2c20.6 0 38.2 13 45 31.2c8.8-9.3 21.2-15.2 35-15.2c25.3 0 46 19.5 47.9 44.3c8.5-7.7 19.8-12.3 32.1-12.3c26.5 0 48 21.5 48 48l0 48 0 16 0 48c0 70.7-57.3 128-128 128l-16 0-64 0-.1 0-5.2 0c-5 0-9.9-.3-14.7-1c-55.3-5.6-106.2-34-140-79L8 336c-13.3-17.7-9.7-42.7 8-56s42.7-9.7 56 8l56 74.7L128 40zM240 304c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 96c0 8.8 7.2 16 16 16s16-7.2 16-16l0-96zm48-16c-8.8 0-16 7.2-16 16l0 96c0 8.8 7.2 16 16 16s16-7.2 16-16l0-96c0-8.8-7.2-16-16-16zm80 16c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 96c0 8.8 7.2 16 16 16s16-7.2 16-16l0-96z"/></svg>                
                <input type="range" id="range" min="5" max="500" value="10">
                <br>
                <input type="number" id="price" placeholder="300$">

                <strong><p id="range-value"></p></strong>
                <p id="range-value-cdf"></p>
            </div>

            <div class="inputSection">
                <label for="rangePersonne">Nombre de personnes</label>
                <input type="range" id="range-personne" min="1" max="25" value="1">
                <strong><p id="range-personne-value"></p></strong>
            </div>

            <div class="inputSection">
                <label for="dateOrNot">C'est un date ? 😘🤭</label>
                <div style="display: flex;justify-content: center; align-items: center; gap: 10px;">
                    <div class="inside">
                        <input type="radio" name="dateOrNot" id="dateOrNot"  value="oui" class="dates"><label for="dateOrNot" class="label">Oui</label>
                    </div>

                    <div class="inside">
                        <input type="radio" name="dateOrNot" id="dateOrNot2" value="No" class="dates"><label for="dateOrNot2" class="label">Non</label>
                    </div>
                    </div>
                </div>
            </div>

            <div class="inputSection button">
                <button type="submit"><a href="#resultats" style="color: inherit; text-decoration: none;">Rechercher</a></button>
            </div>

            <div class="inputSection no-flex" id="indication">
                <p>*La question du date est posée pour vous proposer uniquement les restaurants où vous pourrez faire un date.</p>
            </p>
            </div>
        </form>
    </section>



    <section id="loader-container">

        <div id="loading"></div>

    </section>

    <div class="divider white"></div>
    <div id="resultats" class="no-flex">
    </div>




    <section class="finder">
        <h1>Rechercher un restaurant</h1>
        <form id="searching">
            <input type="text" id="restaurant-name"  placeholder="Nom du restaurant">
            <input type="text" id="restaurant-commune" placeholder="Commune" list="communes">
            <input type="text" id="restaurant-type" placeholder="Type de cuisine" list="types-of-restau">

            <datalist id="types-of-restau">
                <option value="fast-food">Fast food</option>
                <option value="pizzeria">Pizzeria</option>
                <option value="restaurant">Restaurant</option>
                <option value="Lounge Bar">Lounge</option>
                <option value="Bar">Terrasse / Bar</option>
            </datalist>

            <datalist id="communes">
                <option value="kinshasa">Kinshasa</option>
                <option value="Bandal">Bandalungwa</option>
                <option value="Limete">Limete</option>
                <option value="Ngaliema">Ngaliema</option>
                <option value="Kintambo">Kintambo</option>
                <option value="Gombe">Gombe</option>
                <option value="Mont-Ngafula">Mont N'gafula</option>
                <option value="Masina">Masina</option>
                <option value="Kinseso">Kinseso</option>
                <option value="Ngiri-Ngiri">Ngiri-ngiri</option>
                <option value="Barumbu">Bumbu</option>
                <option value="Kimbaseke">Kimbaseke</option>
                <option value="Lemba">Lemba</option>
                <option value="Lingwala">Lingwala</option>
                <option value="Maluku">Maluku</option>
                <option value="Makala">Makala</option>
                <option value="Matete">Matete</option>
                <option value="Ndjili">Ndjili</option>
                <option value="Selembao">Selembao</option>
                <option value="Nsele">Nsele</option>
                <option value="Ngaba">Ngaba</option>
                <option value="Bumbu">Bumbu</option>
                <option value="Kalamu">Kalamu</option>
                <option value="Kasa-vubu">Kasa-vubu</option>
            </datalist>
            
            <button type="submit" id="btn-submit"><span><a href="#resultats" style="color: inherit; text-decoration: none;">Rechercher</a></span></button>
        </form>
    </section>



    <section class="restaurants" id="restau-top">
        <h3>Les meilleures restau rapport qualité / prix</h3>
        <div class="restaurant">
            <div class="image">
                <img src="../Styles/assets/plats2.jpg" alt="images des pastas" loading="lazy">
            </div>
            <div class="infos">
                <h2>Restaurant 1</h2>
                <p>Quartier, Ville</p>
                <p>Type de cuisine</p>
                <p>Heure d'ouverture</p>
                <p>Heure de fermeture</p>
                <p>Numéro de téléphone</p>
            </div>
        </div>
        <div class="restaurant">
            <div class="image">
                <img src="../Styles/assets/plats2.jpg" alt="images des pastas" loading="lazy">
            </div>
            <div class="infos">
                <h2>Restaurant 2</h2>
                <p>Quartier, Ville</p>
                <p>Type de cuisine</p>
                <p>Heure d'ouverture</p>
                <p>Heure de fermeture</p>
                <p>Numéro de téléphone</p>
            </div>
        </div>
    </section>


    <section class="forPhones" id="best-of-container"></section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h4>KIN MENU</h4>
                <p>Simplifiez votre quotidien numérique avec Kin Purchase, un produit Kin Web.</p>
                <div class="social-links">
                    <a href="https://wa.me/833922767"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://instagram.com/Kin_Menu"><i class="fab fa-instagram"></i></a>
                    <a href="https://tiktok.com/KinMenu"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Liens rapides</h4>
                <ul class="footer-links">
                    <li><a href="../index.html">Accueil</a></li>
                    <li><a href="./discover.html">Découvrir</a></li>
                    <li><a href="./apropos.html">À propos</a></li>
                    <li><a href="./login.html">Connexion</a></li>
                    <li><a href="./signup.html">Inscription</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li><a href="mailto:contact@kinmenu.com"><i class="fas fa-envelope"></i> contact@kinmenu.com</a></li>
                    <li><a href="tel:+243833922767"><i class="fas fa-phone"></i> +243 833 922 767</a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Kinshasa, RDC</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Kin Menu. Tous droits réservés.</p>
            <p>Créé par Axel Nodier</p>
        </div>
    </footer>
    <script src="../script/globalLoader.js"></script>
    <script>

        const slider = document.getElementById('range');
        const hand = document.querySelector('.hand');

        slider.addEventListener('input', () => {
            hand.style.display = 'none'; // Cache la main quand l'utilisateur interagit
        });

        setTimeout(() => {
            hand.style.display = 'none'; // Cache la main après un certain temps
        }, 5000);


        // Get a reference to the loader container
    const loaderContainer = document.getElementById('loader-container');

    // Function to show the loader
    function showLoader() {
        if (loaderContainer) {
            loaderContainer.classList.add('show');
        }
    }

    // Function to hide the loader
        function hideLoader() {
            if (loaderContainer) {
                loaderContainer.classList.remove('show');
            }
        }

        // Example usage:
        // Call showLoader() before an asynchronous operation (like a fetch request)
        // showLoader();

        // Then, in your fetch's .then() or .finally() block, call hideLoader()
        // hideLoader();

        // For instance, if you have a button that triggers an action:
        // document.getElementById('myActionButton').addEventListener('click', async () => {
        //     showLoader();
        //     try {
        //         const response = await fetch('/your-api-endpoint');
        //         const data = await response.json();
        //         // Process data here
        //     } catch (error) {
        //         console.error('Error:', error);
        //     } finally {
        //         hideLoader(); // Always hide the loader, even if there's an error
        //     }
        // });
    </script>

    <script src="../script/header.js"></script>
    <script src="../script/discover.js"></script>
    <script src="../script/discover_logged.js"></script>
    <! script src="../configuration/search.js"--!><!/script--!>
    <! script src="../script/internet-checker.js"><!/script--!>

    <!script src="../script/test-discover.js"><!/script--!>
    <!script src="../script/test.js"><!/script--!>


</body>



</html>