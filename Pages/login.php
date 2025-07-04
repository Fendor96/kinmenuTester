<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../Styles/assets/favicon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Permissions-Policy" content="clipboard-read=self, clipboard-write=self">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Préchargement pour optimisation -->
    <link rel="preconnect" href="https://accounts.google.com">
    <link rel="preload" href="https://accounts.google.com/gsi/client" as="script">    
    
    <link rel="stylesheet" href="../Styles/globalLoader.css">
    <link rel="stylesheet" href="../Styles/header.css">
    <link rel="stylesheet" href="../Styles/signup.css">
    <title>Connexion - Kin Menu</title>
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
        <div id="logo"><a href="../index.html" style="text-decoration: none; color: inherit; font-family: inherit;"> KIN <br> MENU</a></div>

        <nav class="nav-links">
            <ul>
                <li><a href="../index.html">Accueil</a></li>
                <li><a href="./discover.html">Découvrir</a></li>
                <li><a href="./apropos.html">À propos</a></li>
            </ul>
            <div class="auth-links">
                <a href="./signup.html">S'inscrire</a>
                <a href="./login.php" class="active">Se connecter</a>
            </div>
        </nav>

        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
        <ul class="mobile-links">
            <li><a href="../index.html">Accueil</a></li>
            <li><a href="./discover.html">Découvrir</a></li>
            <li><a href="./apropos.html">À propos</a></li>
            <li><a href="./signup.html" >S'inscrire</a></li>
            <li><a href="./login.php" class="active">Se connecter</a></li>
        </ul>
    </div>

    <div id="loading-indicator">
        <div class="loader"></div>
    </div>


    <!-- Main Content -->
    <main class="signup-container">
        <div class="signup-card">
            <div class="signup-header">
                <h1>Connectez vous !</h1>
                <p>C'est un plaisir de vous revoir parmis nous !</p>
            </div>
            
            <form class="signup-form" id="login-form">
                <div id="message" style="color: rgb(121, 0, 0); margin-top: 10px; text-align: center;"></div>

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Votre adresse email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="checkbox-container">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        Se souvenir de moi
                    </label>
                </div>
                
                <button type="submit" class="signup-btn">Se connecter</button>
                
                <div class="divider">
                    <span>ou</span>
                </div>
                
                <div class="social-login">
                    <div id="google-login-container" style="display: none;">
                        <button type="button" class="social-btn google-btn" id="google-login-btn">
                            <i class="fab fa-google"></i>
                            Continuer avec Google
                        </button>
                    </div>
                    <button type="button" class="social-btn apple-btn">
                        <i class="fab fa-apple"></i>
                        Continuer avec Apple
                    </button>
                </div>
                
                <div class="login-link">
                    Vous n'avez pas encore de compte? <a href="./signup.html">Créer un compte</a>
                </div>
            </form>

        </div>
    </main>

    <div id="loader" style="display: none;"></div>


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
    <script src="../script/login.js"></script>
    <script src="../script/header.js"></script>
    <script src="../script/internet-checker.js"></script>




</body>
</html>