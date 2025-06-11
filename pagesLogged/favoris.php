<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: ../Pages/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Axel Nodier">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoris & Historique - Recherche par Budget</title>
    <link rel="stylesheet" href="../Styles/globalLoader.css">
    <link rel="stylesheet" href="../Styles/account.css">
    <link rel="stylesheet" href="../Styles/header.css">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="width: 100vw;">
<div id="global-page-loader">
        <div class="loader-content">
            <div class="spinner-kinmenu"></div>
            <div class="loader-text">KIN <br> MENU</div>
        </div>
    </div>
    <!-- Header cohérent avec le style existant -->
    <header style="width: 100% !important;">
        <div id="logo">KIN <br> MENU</div>

        <nav class="nav-links">
            <ul>
                <li><a href="./home.php">Mon dashboard</a></li>
                <li><a href="./discover.php">Rechercher</a></li>
                <li><a href="./favoris.php" class="active">Mes favoris</a></li>
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

    <div class="mobile-menu" id="mobileMenu" style="border: 2px solid orange;">
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
        <ul class="mobile-links">
            <li><a href="./home.php" class="active">Accueil</a></li>
            <li><a href="./discover.php">Rechercher <i class="fa-solid fa-search"></i></a></li>
            <li><a href="./favoris.php" class="active">Mes Favoris <i class="fa-solid fa-heart"></i></a></li>
            <li><a href="./account.php">Mon compte <i class="fa-solid fa-account"></i></a></li>
            <li><a href=".deconnexion.php">Deconnexion <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>    
    <div class="divider orange"></div>

    <main class="favorites-container" style="margin-top: 100px; border: 2px solid red;">
        <section class="favorites-header">
            <h1 style="font-size: 30px !important;"><i class="fas fa-heart" ></i> Vos Favoris & Historique</h1>
            <div class="tabs">
                <button class="tab-btn active" data-tab="favorites"><i class="fas fa-heart"></i> Favoris</button>
                <button class="tab-btn" data-tab="history"><i class="fas fa-history"></i> Historique</button>
                <button class="tab-btn" data-tab="bookings"><i class="fas fa-calendar-check"></i> Réservations</button>
            </div>
        </section>

        <div class="divider green"></div>

        <!-- Section Favoris -->
        <section class="tab-content active" id="favorites">
            <div class="filters">
                <div class="filter-group">
                    <label for="sort-favorites"><i class="fas fa-sort"></i> Trier par :</label>
                    <select id="sort-favorites">
                        <option value="recent">Plus récents</option>
                        <option value="oldest">Plus anciens</option>
                        <option value="price-asc">Budget (croissant)</option>
                        <option value="price-desc">Budget (décroissant)</option>
                        <option value="rating">Meilleures notes</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filter-category"><i class="fas fa-filter"></i> Catégorie :</label>
                    <select id="filter-category">
                        <option value="all">Toutes</option>
                        <option value="restaurant">Restaurants</option>
                        <option value="hotel">Hôtels</option>
                        <option value="activity">Activités</option>
                    </select>
                </div>
                <button class="search-btn"><i class="fas fa-search"></i> Appliquer</button>
            </div>

            <div class="favorites-grid">
                <!-- Item Favori 1 -->
                <div class="favorite-item">
                    <div class="favorite-image" style="background-image: url('assets/restaurants/resto1.jpg');">
                        <button class="favorite-btn active"><i class="fas fa-heart"></i></button>
                        <span class="rating"><i class="fas fa-star"></i> 4.8</span>
                    </div>
                    <div class="favorite-info">
                        <h3>Le Gourmet Parisien</h3>
                        <p class="location"><i class="fas fa-map-marker-alt"></i> Paris 8ème</p>
                        <p class="price"><i class="fas fa-coins"></i> Budget moyen: 65€</p>
                        <div class="favorite-meta">
                            <span class="category">Français</span>
                            <span class="distance">0.8 km</span>
                        </div>
                        <div class="favorite-actions">
                            <a href="#" class="action-btn"><i class="fas fa-info-circle"></i> Détails</a>
                            <a href="#" class="action-btn"><i class="fas fa-bookmark"></i> Réserver</a>
                        </div>
                    </div>
                </div>

                <!-- Plus d'items favoris... -->
            </div>

            <div class="pagination">
                <button class="page-btn disabled"><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>

        <!-- Section Historique -->
        <section class="tab-content" id="history">
            <div class="filters">
                <div class="filter-group">
                    <label for="sort-history"><i class="fas fa-sort"></i> Trier par :</label>
                    <select id="sort-history">
                        <option value="recent">Plus récents</option>
                        <option value="oldest">Plus anciens</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="history-date">Filtrer par date :</label>
                    <input type="month" id="history-date">
                </div>
                <button class="clear-btn"><i class="fas fa-trash-alt"></i> Effacer l'historique</button>
            </div>

            <div class="history-list">
                <!-- Item Historique 1 -->
                <div class="history-item">
                    <div class="history-date">
                        <span class="day">15</span>
                        <span class="month">JUIN</span>
                    </div>
                    <div class="history-content">
                        <h3>Recherche "Restaurants italiens"</h3>
                        <p>Budget: 50-80€ • 3 résultats</p>
                        <div class="history-actions">
                            <a href="#" class="action-link"><i class="fas fa-redo"></i> Relancer</a>
                            <a href="#" class="action-link"><i class="fas fa-heart"></i> Ajouter aux favoris</a>
                        </div>
                    </div>
                </div>

                <!-- Plus d'items historiques... -->
            </div>
        </section>

        <!-- Section Réservations -->
        <section class="tab-content" id="bookings">
            <div class="filters">
                <div class="filter-group">
                    <label for="booking-status"><i class="fas fa-filter"></i> Statut :</label>
                    <select id="booking-status">
                        <option value="all">Toutes</option>
                        <option value="upcoming">À venir</option>
                        <option value="past">Passées</option>
                        <option value="cancelled">Annulées</option>
                    </select>
                </div>
                <button class="search-btn"><i class="fas fa-search"></i> Filtrer</button>
            </div>

            <div class="bookings-list">
                <!-- Réservation 1 -->
                <div class="booking-item upcoming">
                    <div class="booking-image" style="background-image: url('assets/restaurants/resto2.jpg');"></div>
                    <div class="booking-info">
                        <h3>Le Petit Bistrot</h3>
                        <p class="booking-date"><i class="far fa-calendar-alt"></i> 20 Juin 2023 - 20:00</p>
                        <p class="booking-details">2 personnes • Table en terrasse</p>
                        <p class="booking-price">Total: 120€</p>
                        <div class="booking-status">Confirmée</div>
                        <div class="booking-actions">
                            <button class="action-btn"><i class="fas fa-edit"></i> Modifier</button>
                            <button class="action-btn cancel"><i class="fas fa-times"></i> Annuler</button>
                        </div>
                    </div>
                </div>

                <!-- Plus de réservations... -->
            </div>
        </section>
    </main>

    <footer>
        <!-- Footer existant -->
    </footer>
    <script src="../script/globalLoader.js"></script>
    <script>
        // Gestion des onglets
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Retirer active de tous les boutons et contenus
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Ajouter active au bouton cliqué
                btn.classList.add('active');
                
                // Afficher le contenu correspondant
                const tabId = btn.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Boutons favoris
        const favoriteBtns = document.querySelectorAll('.favorite-btn');
        favoriteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });

        // Menu hamburger

        // Pagination
        const pageBtns = document.querySelectorAll('.page-btn:not(.disabled)');
        pageBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelector('.page-btn.active').classList.remove('active');
                this.classList.add('active');
            });
        });
    </script>
    <script src="../script/header.js"></script>
</body>
</html>