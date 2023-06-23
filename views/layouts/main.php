<?php
use App\src\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Mon Blog</title>
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
                    <li><a href="/posts"><span class='head-text'>Posts</span></a></li>
                    <li><a href="/login"><span class="head-text">Connexion</span></a></li>
                    <li><a href="/signup"><span class="head-text">S'inscrir</span></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <?php if (Application::$app->session->getFlash("success")) { ?>
        <div style="margin-top:34px;" class="alert-sucess">
            <?= Application::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>

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