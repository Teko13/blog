<?php
use App\src\Application;

$userSession = Application::$app->session->get('user');
?>
<div class="nav__links">
    <ul class="nav__list">
        <li><a href="/admin/"><span class='head-text'>Tableau de bord</span></a></li>
        <li><a href="/admin/create-post"><span class="head-text">Créer un post</span></a></li>
        <li><a href="/admin/manage-post"><span class="head-text">Gerer posts</span></a></li>
        <?php if (Application::$app->session->get("user")["type"] === 2) { ?>
            <ul class="validation-groupe">
                <li class="validation-libelle">
                    <span>Validation</span><span id="validation-menu-arrow" class="material-symbols-outlined">
                        arrow_drop_down
                    </span>
                </li>
                <ul class="validation-groupe-items">
                    <li><a href="/admin/comments-validation">Commentaires</a></li>
                    <li><a href="/admin/users-validation">Utilisateurs</a></li>
                </ul>
            </ul>
        <?php } ?>
        <li><a href="/logout"><span class="head-text">Déconnexion</span></a></li>
        <div class="user-blaz">
            <span class="user-initial">
                <?= strtoupper(substr($userSession['firstName'], 0, 1)); ?>
                <?= strtoupper(substr($userSession['lastName'], 0, 1)); ?>
            </span>
            <span class="user-firstName">
                <?= ucfirst($userSession['firstName']); ?>
            </span>
        </div>
    </ul>
    <div class="menu-icons">
        <i class="fa-solid fa-bars no-deployed"></i>
        <i class="fa-solid fa-xmark deployed"></i>
    </div>
</div>
<script src="/validation-menu-deploy.js"></script>
