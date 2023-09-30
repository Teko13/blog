<?php
use App\models\User;
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
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Mon Blog</title>
</head>

<body>
    <header class='container head-container'>
        <nav class='head__nav'>
            <a href="/">
                <h2>Teko</h2>
            </a>
            <?php
            $path = Application::$app->request->getPath();
            if (isset(Application::$app->session->get("user")["type"])) {
                if ((strpos($path, "/admin/") === 0) && (Application::$app->session->get("user")["type"] >= User::STATUS_VALIDE)) {
                    include Application::$ROOT_DIR . "/views/layouts/admin-navbar.php";
                } else {
                    include Application::$ROOT_DIR . "/views/layouts/logged-navbar.php";
                }
            } else {
                include Application::$ROOT_DIR . "/views/layouts/no-logged-navbar.php";
            }
            ?>
        </nav>
    </header>
    <?php if (Application::$app->session->getFlash("success")) { ?>
        <div class="alert-flash">
            <div class="alert-flash-content">
                <?= Application::$app->session->getFlash('success'); ?>
            </div>
        </div>
    <?php } ?>

    {{content}}

    <footer id='footer'>
        <a href="#" class="footer__logo">Teko</a>
        <div class="footer__socials">
            <a href="https://www.facebook.com/Parlons-Techs-104050835687569/" target='_blank'>
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://www.instagram.com/tekofabricefolly/" target='_blank'>
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://twitter.com/TekoFabriceF" target='_blank'>
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>
    </footer>
    <script src="/navbar.js"></script>
</body>

</html>
