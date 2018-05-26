
<?php $title_for_layout = $entreprise->e_nom ?>
<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/validEntreprise/<?= $entreprise->e_code ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Entreprise</legend>
        <p style="color: red; font-weight: bold;"><?= $message ?></p>
        <p style="color: green; font-weight: bold;"><?= $messageok ?></p>
        <?php
        if ($role == 'admin') {
            include 'modifierEntreprise.php';
            ?>
            <div class="form-group btn_validEnt">
                <button id="submit" name="submit" class="btn btn-success">Modifier</button>         
            </div>
            <?php
        } else {
            include 'affichEntreprise.php';
        }
        ?>        
    </fieldset>
</form>
