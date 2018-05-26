
<?php $title_for_layout = 'Nouvelle Entreprise' ?>
<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/nouveau" >
    <fieldset>

        <!-- Form Name -->
        <legend>Entreprise</legend>
        <div><font size='4' color='green'><strong><?= $message ?><strong></font></div>
                    <?php include 'formEntreprise.php' ?>       

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="singlebutton"></label>
                        <div class="col-md-4">
                            <button id="singlebutton" name="submit" class="btn btn-info">Créer</button>
                        </div>
                    </div>
    </fieldset>
</form>
