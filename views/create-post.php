<?php
use App\src\Application;
use App\src\Form;

$userSession = Application::$app->session->get("user");
?>
<section>
    <div class="container post-creation-form">
        <h1>Création de Post</h1>
        <?php $form = Form::startTag("/admin/create-post", "post");
        echo $form->field($post, "title", "Titre");
        echo $form->field($post, "chapo", "Chapo");
        echo $form->field($post, "id_author", "")->typeHidden()->setValue($userSession['id']);
        ?>
        <textarea name="content" placeholder="Votre contenue" cols="30" rows="5"></textarea>
        <button class="btn btn-primary" type="submit">Créer</button>
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
        <?php Form::endTag(); ?>
    </div>
</section>
