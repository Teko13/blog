<?php

use App\src\Application;


$userSession = Application::$app->session->get("user");

$authorFirstName = $post['post']["user_firstName"];
$authorLastName = $post['post']["user_lastName"];
$title = $post['post']["title"];
$chapo = $post['post']["chapo"];
$content = $post['post']["content"];
$idPost = $post['post']['id'];
$updatedAt = $post['post']['updated_at'];
$comments = $post['comments'];
?>
<section>
    <div class="container">
        <div class="post-container details">
            <div class="author">
                <span class="user-initial">
                    <?= strtoupper(substr($authorFirstName, 0, 1)); ?>
                    <?= strtoupper(substr($authorLastName, 0, 1)); ?>
                </span>
                <span class="user-firstName">
                    <?= ucfirst($authorFirstName) . " " . ucfirst($authorLastName); ?>
                </span>
            </div>
            <i>
                <?= $updatedAt; ?>
            </i>
            <h1>
                <?= $title; ?>
            </h1>
            <div class="chapo">
                <?= $chapo; ?>
            </div>
            <div class="post-content">
                <?= $content; ?>
            </div>
        </div>
        <div class="comment-container">
            <h2 id="comment">Commentaire</h2>
            <form action="/comment" method="post" class="comment-form">
                <input type="hidden" name="id_post" value=<?= $idPost ?>>
                <textarea name="content" placeholder="Votre commentaire" cols="30" rows="5"></textarea>
                <?php if (Application::$app->session->getFlash("succes") !== null) { ?>
                    <span class="msg succes">
                        <?= Application::$app->session->getFlash("succes"); ?>
                    </span>
                <?php } elseif (Application::$app->session->getFlash("error") !== null) {
                    foreach (Application::$app->session->getFlash("error") as $field => $msg) { ?>
                        <span class="msg error">
                            <?= $field . ': ' . $msg; ?>
                        </span>
                    <?php } ?>
                <?php } ?>
                <?php if (!isset($userSession)) { ?>
                    <div class='unauthorization-msg'>
                        <span class="material-symbols-outlined">
                            warning
                        </span>
                        <span>Vous devez être connecter pour soumettre un commentaire</span>
                    </div>
                <?php } ?>
                <button class="btn btn-primary" type="submit" <?php echo !isset($userSession) ? 'disabled' : "" ?>>
                    <span>Soumettre</span>
                    <span class="material-symbols-outlined">
                        send
                    </span>
                </button>
            </form>
            <div class="comment-list">
                <?php foreach ($comments as $comment) { ?>
                    <div class="comment">
                        <div class="comment-header">
                            <h3>
                                <?= ucfirst($comment["user_firstName"]) . ' ' . strtoupper($comment["user_lastName"]); ?>
                            </h3>
                            -
                            <i>
                                <?= $comment["created_at"] ?>
                            </i>
                        </div>
                        <div class="comment-content">
                            <?= $comment["content"] ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>