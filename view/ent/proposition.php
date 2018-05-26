<?php $title_for_layout = 'Choix de l\'entreprise'; ?>
<?php if ($entreprise == '') : ?>
    <form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/proposition"  >
        <fieldset>

            <!-- Form Name -->
            <legend>Qui êtes-vous ?</legend>
            <select class='form-control' name="e_code">
                <?php foreach ($entreprises as $value): ?>
                <option value='<?= $value->e_code ?>' ><?= $value->e_nom ?> - <?= $value->e_adresse1 ?>, <?= $value->e_ville ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <!-- Button -->
            <div class="form-group">
                <img src='../webroot/img/Informations.png' width="50px" class='col-md-1'><p class='col-md-4'>
                    Vous n'êtes pas dans la liste ? <br>
                    Inscrivez-vous : <a href="<?= BASE_URL ?>/ent/nouveau" id="singlebutton" name="singlebutton" class="btn btn-info"> S'inscrire</a>
                </p>
                <div class="col-md-7">
                    <label class="col-md-9 control-label" for="singlebutton"></label>
                    <input type="submit" value='Valider' class="btn btn-info col-md-3">
                </div>
            </div>
        </fieldset>
    </form>
<?php endif; ?>
<?php if ($entreprise != '') { ?>
    <form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/formProposition/<?= $entreprise->e_code ?>">
        <fieldset>
            <legend>Détails de votre entreprise</legend>
            <?php include 'affichEntreprise.php'; ?>
            <label class="col-md-2 control-label" for="singlebutton"></label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-info">Suivant</button>
            </div>
        </fieldset>
    </form><br>
<?php } ?><br>
