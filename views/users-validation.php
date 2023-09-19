<?php
use App\src\Application;

?>
<section class="container">
    <h1>Gestion utilisateurs</h1>
    <div class="search-enginne">
        <span class="material-symbols-outlined">
            search
        </span>
        <input type="text" placeholder="Rechercher: Nom, Prénom, Email..." id="search">
    </div>
    <article class="users">
        <?php
        foreach ($users as $user) {
            $userId = $user->id;
            ?>
            <div class="user">
                <div class="user-infos">
                    <h2>
                        <?= $user->email ?>
                    </h2>
                    <i>
                        <?= $user->firstName . " " . $user->lastName ?>
                    </i>
                    <span>
                        Status:
                        <?php
                        switch ($user->type) {
                            case 0:
                                echo "Inscrit";
                                break;
                            case 1:
                                echo "Validé (Créateur)";
                                break;
                            case 2:
                                echo "Admin";
                                break;

                            default:
                                echo "Inconnu";
                                break;
                        }
                        ?>
                    </span>
                </div>
                <div class="actions">
                    <button onclick=<?= "window.location.href='/admin/valide?id=$userId&status=1'" ?> class="btn btn-primary"
                        <?= ($user->type === 1) ? 'disabled' : ""; ?>>Valider (créateur) </button>
                    <button onclick=<?= "window.location.href='/admin/valide?id=$userId&status=0'" ?> class="btn"
                        <?= ($user->type === 0) ? 'disabled' : ""; ?>>Inscrit</button>
                    <button onclick=<?= "window.location.href='/admin/valide?id=$userId&status=2'" ?> class="btn succes"
                        <?= ($user->type === 2) ? 'disabled' : '' ?>>Admin</button>
                    <button onclick=<?= "window.location.href='/admin/user-deletion?id=$userId'" ?>
                        class="btn error">Supprimer</button>
                </div>
            </div>
        <?php } ?>
    </article>
</section>
<script src="/users-search.js"></script>
