<section class="container">
    <h1>Posts</h1>
    <?php
    foreach ($posts as $post) { ?>
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
            <a href=<?= "/post?id=" . $post->id; ?> class="btn btn-primary">Voir le post</a>
        </div>
    <?php } ?>
</section>
