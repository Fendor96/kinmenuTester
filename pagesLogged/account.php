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
    <title>Mon Compte - Recherche par Budget</title>
    <link rel="stylesheet" href="../Styles/globalLoader.css">
    <link rel="stylesheet" href="../Styles/account.css">
    <link rel="stylesheet" href="../Styles/header.css">
    <link rel="stylesheet" href="../Styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="global-page-loader">
        <div class="loader-content">
            <div class="spinner-kinmenu"></div>
            <div class="loader-text">KIN <br> MENU</div>
        </div>
    </div>
<header>
        <div id="logo">KIN <br> MENU</div>

        <nav class="nav-links">
            <ul>
                <li><a href="./home.php">Mon dashboard</a></li>
                <li><a href="./discover.php">Rechercher</a></li>
                <li><a href="./favoris.php">Mes favoris</a></li>
                <li><a href="./account.php" class="active">Mon compte</a></li>
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
            <li><a href="./home.php">Accueil</a></li>
            <li><a href="./discover.php">Rechercher <i class="fa-solid fa-search"></i></a></li>
            <li><a href="./favoris.php">Mes Favoris <i class="fa-solid fa-heart"></i></a></li>
            <li><a href="./account.php" class="active">Mon compte <i class="fa-solid fa-account"></i></a></li>
            <li><a href=".deconnexion.php">Deconnexion <i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>

    <div class="divider orange"></div>

    <main class="account-container" style="margin-top: 100px;">
        <section class="account-header">
            <div class="profile-card">
                <div class="profile-avatar">
                    <img src="../Styles/assets/chicken.png" alt="Photo de profil">
                    <button class="edit-avatar"><i class="fas fa-camera"></i></button>
                </div>
                <div id="messageDiv"></div>
                <div class="profile-info">
                    <h1 id="nom"></h1>
                    <p class="member-since" id="date"></p>
                    <div class="profile-stats">
                        <div class="stat">
                            <span class="number" id="historique"></span>
                            <span class="label">Recherches</span>
                        </div>
                        <div class="stat">
                            <span class="number" id="favoris"></span>
                            <span class="label">Favoris</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider green"></div>

        <section class="account-sections">
            <div class="account-nav">
                <button class="tab-btn active" data-tab="infos"><i class="fas fa-user-edit"></i> Informations</button>
                <button class="tab-btn" data-tab="security"><i class="fas fa-lock"></i> Sécurité</button>
                <button class="tab-btn" data-tab="preferences"><i class="fas fa-cog"></i> Préférences</button>
                <button class="tab-btn" data-tab="notifications"><i class="fas fa-bell"></i> Notifications</button>
            </div>

            <div class="account-content">
                <!-- Section Informations -->
                <div class="tab-content active" id="infos">
                    <h2><i class="fas fa-user-edit"></i> Informations Personnelles</h2>
                    <form class="account-form">
                        <div class="form-group double">

                            <div class="input-group">
                                <label for="nomInput">Nom d'utilisateur</label>
                                <input type="text" id="nomInput">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone">
                        </div>
                        <button type="submit" class="save-btn">Enregistrer les modifications</button>
                    </form>
                </div>

                <!-- Section Sécurité -->
                <div class="tab-content" id="security">
                    <h2><i class="fas fa-lock"></i> Sécurité du Compte</h2>
                    <form class="account-form">
                        <div class="form-group">
                            <label for="current-password">Mot de passe actuel</label>
                            <input type="password" id="current-password" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nouveau mot de passe</label>
                            <input type="password" id="new-password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmer le nouveau mot de passe</label>
                            <input type="password" id="confirm-password">
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar"></div>
                            <span class="strength-text">Force du mot de passe: <span>Faible</span></span>
                        </div>
                        <button type="submit" class="save-btn">Mettre à jour le mot de passe</button>
                    </form>
                </div>

                <!-- Section Préférences -->
                <div class="tab-content" id="preferences">
                    <h2><i class="fas fa-cog"></i> Préférences</h2>
                    <form class="account-form">
                        <div class="form-group">
                            <label>Thème de l'application</label>
                            <div class="theme-options">
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="light" checked>
                                    <span class="theme-preview light"></span>
                                    <span>Clair</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="dark">
                                    <span class="theme-preview dark"></span>
                                    <span>Sombre</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="theme" value="system">
                                    <span class="theme-preview system"></span>
                                    <span>Système</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="language">Langue</label>
                            <select id="language">
                                <option value="fr" selected>Français</option>
                                <option value="en">English</option>
                                <option value="es">Español</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="currency">Devise</label>
                            <select id="currency">
                                <option value="EUR" selected>Euro (€)</option>
                                <option value="USD">Dollar ($)</option>
                                <option value="GBP">Livre (£)</option>
                            </select>
                        </div>
                        <button type="submit" class="save-btn">Enregistrer les préférences</button>
                    </form>
                </div>

                <!-- Section Notifications -->
                <div class="tab-content" id="notifications">
                    <h2><i class="fas fa-bell"></i> Préférences de Notifications</h2>
                    <form class="account-form">
                        <div class="form-group toggle-group">
                            <label>Notifications par email</label>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group toggle-group">
                            <label>Notifications push</label>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group toggle-group">
                            <label>Nouveautés et offres</label>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group toggle-group">
                            <label>Alertes budget</label>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <button type="submit" class="save-btn">Enregistrer les préférences</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include_once 'footer.php' ;?>


    <script src="../script/globalLoader.js"></script>
    <script src="../script/header.js"></script>
    <script src="../script/userGestion.js"></script>
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

        // Menu hamburger

        // Force du mot de passe
        const passwordInput = document.getElementById('new-password');
        const strengthBar = document.querySelector('.strength-bar');
        const strengthText = document.querySelector('.strength-text span');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Longueur
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Complexité
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Mise à jour UI
            strengthBar.style.width = `${strength * 20}%`;
            
            if (strength <= 2) {
                strengthBar.style.backgroundColor = 'var(--colorPrinc)';
                strengthText.textContent = 'Faible';
            } else if (strength <= 4) {
                strengthBar.style.backgroundColor = 'orange';
                strengthText.textContent = 'Moyenne';
            } else {
                strengthBar.style.backgroundColor = 'var(--colorSecon)';
                strengthText.textContent = 'Forte';
            }
        });
    </script>

</body>
</html>