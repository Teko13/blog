<section class="auth">
    <div class="container">
        <h1>Inscription</h1>
        <?php if (isset($model)) { ?>
            <ul class='errors'>
                <?php
                foreach ($model->errors as $field => $error) { ?>
                    <li>
                        <i>
                            <?= $field ?>:Ò
                            <?= $error ?>
                        </i>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php $form = \App\src\Form::startTag("/signup", "post"); ?>
        <?php echo $form->field($model, "firstName", "Prenom"); ?>
        <?php echo $form->field($model, "lastName", "Nom"); ?>
        <?php echo $form->field($model, "email", "Email"); ?>
        <?php echo $form->field($model, "password", "Mot de passe")->typePassword(); ?>
        <button class='btn btn-primary' type='submit'>S'inscrir</button>
        <?php \App\src\Form::endTag(); ?>

    </div>
</section>
