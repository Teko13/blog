<section class="container auth">
    <div>
        <h2>Connexion</h2>
        <?php if (isset($model)) { ?>
            <ul class='errors'>
                <?php
                foreach ($model->errors as $field => $error) { ?>
                    <li>
                        <i>
                            <?= $field ?>:
                            <?= $error ?>
                        </i>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php $form = \App\src\Form::startTag("/login", "post"); ?>
        <?php echo $form->field($model, "email", "Email")->typeEmail(); ?>
        <?php echo $form->field($model, "password", "Mot de passe")->typePassword(); ?>
        <button class='btn btn-primary' type='submit'>Connexion</button>
        <?php \App\src\Form::endTag(); ?>

    </div>
</section>
