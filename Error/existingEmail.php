<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="author" content="Axel Nodier">
        <meta name="keywords" content="menu, restaurant, kinshasa restaurant, reservation">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../Styles/discover.css">
        <link rel="stylesheet" href="../Styles/header.css">
    
        <!--Title-->
        <title>Erreur de connexion - Kin Menu</title>

        <style>
            section{
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items:center;
                width: 100vw;
                height: 100vh;
            }

            .divider{
               background-color:#db3a00;
                height: 0.5vh;
                width: 90%;
                margin: 10px auto;
            }

            .img{
                background: url('../Styles/assets/Mining Sugar 🍭.gif');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                width: 200px;
                height: 200px;
            }

            a{
                text-decoration: none;
                border: 1px solid #db3a00;
                padding: 8px;
                margin: 10px auto;
                font-family:sans-serif;
            }

            a:hover{
                scale: 1.1;
                transition: 0.4s ease-in-out;
                cursor: pointer;
                text-decoration: underline;
            }
        </style>

    </head>

    <body>
        <section>
            <h1>Oups... ! </h1>
            <div class="divider"></div>
            <p>Il semblerait que l'adresse Email que vous avez entré existe déjà !</p>

            <div class="img"></div>

            <a href="../Pages/login.html">Se connecter à son compte</a>
            <a href="../Pages/signup.html">Continuer avec une autre adresse mail</a>

        </section>
    </body>
</html>