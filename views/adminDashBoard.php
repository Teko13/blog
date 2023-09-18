<?php
use App\models\User;
use App\src\Application;

$userSession = Application::$app->session->get('user');
$postsNumber = count($postsInfos['posts']);
$commentsNumber = 0;
foreach ($postsInfos['comments'] as $comment) {
    $commentsNumber += count($comment);
}

?>
<section class="container">
    <div class="admin-dashboard-container">
        <div class="admin-profil-blaz">
            <?= ucfirst($userSession['firstName'][0]) ?>
            <?= ucfirst($userSession['lastName'][0]) ?>
        </div>
        <h1>
            <?= ucfirst($userSession['firstName']) . " " . strtoupper($userSession['lastName']) ?>
        </h1>
        <div class="status-infos-container">
            <h3>Statut</h3>
            <div class="status-infos succes">
                <?php if ($userSession['type'] > User::STATUS_VALIDE) { ?>
                    <span class="status-title">Admin</span>
                    <span class="material-symbols-outlined">
                        military_tech
                    </span>
                <?php } else { ?>
                    <span class="status-title">Créateur</span>
                    <span class="material-symbols-outlined">
                        edit_note
                    </span>
                <?php } ?>
            </div>
        </div>
        <div class="publication-infos-container">
            <div class="posts-published">
                <span class="publishing-number">
                    <?= $postsNumber ?>
                </span>
                <span class="publishing-title">Post</span>
            </div>
            <div class="posts-published">
                <span class="publishing-number">
                    <?= $commentsNumber ?>
                </span>
                <span class="publishing-title">Commentaires</span>
            </div>
        </div>
    </div>
</section>
