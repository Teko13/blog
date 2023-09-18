<?php
use App\models\Post;

?>
<section class="container">
    <h1>Gestion de(s) post(s)</h1>
    <?php
    foreach ($posts as $post) {
        $post = (object) $post; ?>
        <div class="post-container">
            <div class="date">
                <?= $post->updated_at; ?>
            </div>
            <h2>
                <?= $post->title; ?>
            </h2>
            <div class="chapo">
                <?= $post->chapo; ?>
            </div>
            <div class="actions">
                <a href=<?= "/post?id=" . $post->id; ?> class="btn btn-primary">Voir le post</a>
                <a href=<?= "/admin/edit-post?id=" . $post->id; ?> class="btn"><span>Modifier</span>
                    <span class="material-symbols-outlined">
                        auto_fix_normal
                    </span>
                </a>
                <a href=<?= "/admin/delet-post?id=" . $post->id; ?> onclick="return confirm('Confirmez suppression');"
                    class="btn warning"><span>Supprimer</span>
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </a>
            </div>
        </div>
    <?php } ?>
</section>
