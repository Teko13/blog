<?php
use App\models\User;
use App\src\Application;

$userSession = Application::$app->session->get('user');
$isValid = $userSession["type"] > User::STATUS_INVALIDE ? true : false;
?>
<div class="nav__links">
    <ul class="nav__list">
        <li><a href="/"><span class='head-text'>Accueil</span></a></li>
        <li><a href="/posts"><span class="head-text">Posts</span></a></li>
        <li><a href="/logout"><span class="head-text">Déconnexion</span></a></li>
        <button <?= !$isValid ? "title='Vous pouvez accéder à l&#39;espace administration quand votre compte sera validé'" : "title='accéder à l&#39;espace administration'" ?> onclick='window.location.href="/admin/"'
            class="user-blaz" <?= !$isValid ? "disabled" : "" ?>>
            <span class="user-initial">
                <?= strtoupper(substr($userSession['firstName'], 0, 1)); ?>
                <?= strtoupper(substr($userSession['lastName'], 0, 1)); ?>
            </span>
            <span class="user-firstName">
                <?= ucfirst($userSession['firstName']); ?>
            </span>
        </button>
    </ul>
    <div class="menu-icons">
        <i class="fa-solid fa-bars no-deployed"></i>
        <i class="fa-solid fa-xmark deployed"></i>
    </div>
</div>
