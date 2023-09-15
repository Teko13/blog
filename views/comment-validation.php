<section class="container">
    <h1>Gestion commentaires</h1>
    <div class="comment-validation-view">
        <?php
        foreach ($comments as $comment) {
            $commentId = $comment["id"]; ?>
            <div class="comment-bloc">
                <div class="comment-details">
                    <h3>
                        Auteur:
                        <i>
                            <?= $comment["user_email"] ?>
                        </i>
                    </h3>
                    <h4>
                        Titre du post:
                        <i>
                            <?= $comment['post_title'] ?>
                        </i>
                    </h4>
                    <h4>
                        Statut:
                        <i class=<?= $comment["status"] === "invalid" ? "error" : "succes"; ?>>
                            <?= $comment["status"] === "invalid" ? "Non validé" : "Validé"; ?>
                        </i>
                    </h4>
                    <p>
                        <strong>Contenu:</strong><br>
                        <?= $comment["content"] ?>
                    </p>
                </div>
                <div class="comment-actions">
                    <button onclick=<?= "window.location.href='/admin/comment-validation?id=$commentId&status=valide'" ?>
                        <?= ($comment["status"] === "valide") ? 'disabled' : ""; ?> class="btn btn-primary">Valider</button>
                    <button onclick=<?= "window.location.href='/admin/comment-validation?id=$commentId&status=invalide'" ?>
                        <?= ($comment["status"] === "invalide") ? 'disabled' : ""; ?> class="btn">Dévalider</button>
                    <button onclick=<?= "window.location.href='/admin/comment-deletion?id=$commentId'" ?>
                        class="btn">Supprimer</button>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</section>
