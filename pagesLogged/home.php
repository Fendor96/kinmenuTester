<?php
    session_start();
    if(isset($_SESSION['username'])){

    }else{
        header('Location: ../Pages/login.php');
    }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Dashboard - Kin Menu</title>

    <!-- Fonts and Icons -->
    <link rel="icon" href="./Styles/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&family=Pacifico&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="../Styles/home.css">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link rel="stylesheet" href="../Styles/header.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header cohérent avec le style existant -->
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
            <li><a href="./index.html" class="active">Accueil</a></li>
            <li><a href="./Pages/discover.html">Rechercher <i class="fa-solid fa-search"></i></a></li>
            <li><a href="./Pages/apropos.html">Mes Favoris <i class="fa-solid fa-heart"></i></a></li>
            <li><a href="./Pages/signup.html">Mon compte <i class="fa-solid fa-account"></i></a></li>
            <li><a href="./Pages/login.html">Deconnexion <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>



    <div class="divider orange"></div>

    <main class="dashboard-container" style="margin-top: 100px;">
        <!-- Section Bienvenue et Stats -->
        <section class="dashboard-header">
            <div class="welcome-box">
                <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h1>
                <p>Que souhaitez-vous faire aujourd'hui ?</p>
            </div>
            <div class="stats-box">
                <div class="stat-item">
                    <i class="fas fa-heart" style="color: var(--colorPrinc);"></i>
                    <span class="stat-number" id="favoris"></span>
                    <span class="stat-label">Favoris</span>
                    <span id="messageDiv" style="color: red;text-align:center;"></span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-search" style="color: var(--colorSecon);"></i>
                    <span class="stat-number" id="historique"></span>
                    <span class="stat-label">Recherches</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-calendar-check" style="color: var(--colorPrinc);"></i>
                    <span class="stat-number">5</span>
                    <span class="stat-label">Réservations</span>
                </div>
            </div>
        </section>

        <!-- Recherche Rapide -->
        <section class="quick-search-section">
            <h2><i class="fas fa-bolt"></i> Recherche Rapide</h2>
            <form class="quick-search-form">
                <div class="form-group">
                    <label for="budget"><i class="fas fa-coins"></i> Budget Max</label>
                    <input type="range" id="budget" min="0" max="1000" step="10" value="300">
                    <output for="budget" id="budgetValue">300 €</output>
                </div>
                <div class="form-group">
                    <label for="category"><i class="fas fa-tags"></i> Catégorie</label>
                    <select id="category">
                        <option value="restaurant">Restaurants</option>
                        <option value="fast-food">Fast food</option>
                        <option value="activity">Activités</option>
                        <option value="shopping">Lunch & Terasse</option>
                    </select>
                </div>  
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Trouver
                </button>
            </form>
        </section>

        <div class="divider green"></div>

        <!-- Dernières Activités -->
        <section class="recent-activities">
            <h2><i class="fas fa-clock"></i> Activités Récentes</h2>
            <div class="activities-grid">
                <div class="activity-card">
                    <div class="activity-icon" style="background-color: #ffece5;">
                        <i class="fas fa-utensils" style="color: var(--colorPrinc);"></i>
                    </div>
                    <div class="activity-info">
                        <h3>Restaurant "Le Gourmet"</h3>
                        <p>Budget: 250€ • 15/06/2023</p>
                        <a href="#" class="activity-link">Voir détails <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <!-- Plus d'activités... -->
            </div>
        </section>

        <!-- Recommandations -->
        <section class="recommendations">
            <h2><i class="fas fa-star"></i> Pour Vous</h2>
            <div class="recommendations-grid">
                <div class="recommendation-card">
                    <div class="recommendation-image" style="background-image: url('assets/resto1.jpg');"></div>
                    <div class="recommendation-content">
                        <h3>Top 5 restaurants à moins de 50€</h3>
                        <div class="recommendation-meta">
                            <span><i class="fas fa-coins"></i> Économique</span>
                            <span><i class="fas fa-thumbs-up"></i> 92%</span>
                        </div>
                        <a href="#" class="recommendation-link">Découvrir</a>
                    </div>
                </div>
                <!-- Plus de recommandations... -->
            </div>
        </section>
    </main>

        <!-- Footer existant -->
    <?php require_once 'footer.php'; ?>         

    <script src="../script/userGestion.js"></script>
    <script src="../script/header.js"></script>
    <script>
        // Gestion du slider budget
        const budgetSlider = document.getElementById('budget');
        const budgetValue = document.getElementById('budgetValue');
        
        budgetSlider.addEventListener('input', function() {
            budgetValue.value = this.value + ' €';
        });

        // Menu hamburger
        document.getElementById('hamburgerBtn').addEventListener('click', function() {
            document.querySelector('.nav').classList.toggle('activate');
        });
    </script>
</body>
</html>