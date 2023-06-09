<?php
use App\src\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <header class='container head-container'>
        <nav class='head__nav'>
            <a href="#">
                <h2>Teko</h2>
            </a>
            <div class="nav__links">
                <ul class="nav__list">
                    <li><a href="/"><span class='head-text'>Accueil</span></a></li>
                    <li><a href="/login"><span class="head-text">Posts</span></a></li>
                    <li><a href="/signup"><span class="head-text">Créer un post</span></a></li>
                    <li><a href="/signup"><span class="head-text">Gerer posts</span></a></li>
                    <li><a href="/logout"><span class="head-text">Déconnexion</span></a></li>
                    <li><a href="#"><span class="head-text">Validation</span></a></li>
                </ul>
                <div class="user-blaz">
                    <span class="user-initial">
                        <?= strtoupper(substr($_SESSION['user']['firstName'], 0, 1)); ?>
                        <?= strtoupper(substr($_SESSION['user']['lastName'], 0, 1)); ?>
                    </span>
                    <span class="user-firstName">
                        <?= ucfirst($_SESSION['user']['firstName']); ?>
                    </span>
                </div>
            </div>
        </nav>
    </header>
    {{content}}

    <footer id='footer'>
        <a href="#" class="footer__logo">Teko</a>
        <ul class="permalinks">
            <li><a href="#about">A propos de moi</a></li>
            <li><a href="#competences">Mes competences</a></li>
            <li><a href="#skills">Mes savoir-faire</a></li>
            <li><a href="#portfolio">Portfolio</a></li>
            <li><a href="#contact">Mes coordonnées</a></li>
        </ul>
        <div class="footer__socials">
            <a href="https://www.facebook.com/Parlons-Techs-104050835687569/" target='_blank'>
                <FaFacebookF />
            </a>
            <a href="https://www.instagram.com/tekofabricefolly/" target='_blank'>
                <FiInstagram />
            </a>
            <a href="https://twitter.com/TekoFabriceF" target='_blank'>
                <IoLogoTwitter />
            </a>
        </div>
    </footer>
</body>


</html>