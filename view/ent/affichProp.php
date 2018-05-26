<!-- Text input-->
<?php $title_for_layout = "Propositions" ?>
<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/validProp/<?= $e_code ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Proposition de <?php if ($proposition->p_type == "S"){ echo 'Stage'; } else { echo "Emploi";}?> par l'entreprise : <?php echo $proposition->e_nom  ?></legend>
        <div class="col-md-12">
            <div class="form-group">
                <p style="color:green;"><?= $messageok ?></p>
                <p style="color:red;"><?= $message ?></p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-3 control-label" for="p_designation">Intitulé </label>  
                <div class="col-md-4">
                    <input id="p_designation" name="p_designation" placeholder="PHP" class="form-control input-md" type="text" value="<?php if($proposition->p_designation != ''){ echo $proposition->p_designation; } ?>">
                </div>
            </div> 
            
            <?php if ($proposition->p_type == "E"): ?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Type de contrat (CDI, CDD, ...)</label>
                <div class="col-md-7">
                    <select name="e_contrat" id="e_contrat" class="form-control input-md">
                        <option value="CDI" <?php if( $emploi->e_contrat == "CDI") {echo 'selected';} ?>>CDI – Contrat à durée indéterminée</option>
                        <option value="CDD" <?php if( $emploi->e_contrat == "CDD") {echo 'selected';} ?>>CDD – Contrat à durée déterminée</option>
                        <option value="CTT" <?php if( $emploi->e_contrat == "CTT") {echo 'selected';} ?>>CTT – Contrat de travail temporaire ou Intérim</option>
                        <option value="CA" <?php if( $emploi->e_contrat == "CA") {echo 'selected';} ?>>Contrat d’apprentissage (alternance)</option>
                    </select>
                </div>        
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Localisation</label>  
                <div class="col-md-4">
                    <input id="p_localisation" name="p_localisation" placeholder="Localisation du poste" class="form-control input-md" type="text" value="<?php if($proposition->p_localisation != ''){ echo $proposition->p_localisation; } ?>">
                </div>
            </div>
        </div>
        <!-- durée, date debut, date de fin, avantages -->
        <?php if ($proposition->p_type == "S"): ?>
        <div class="form-group">
                <label class="col-md-3 control-label" for="description">Date de début</label>
                <div class="col-md-4">
                    <input type="date" name="s_datedebut" id="s_datedebut" placeholder="Date de début" class="form-control input-md" value="<?= (isset($stage->s_datedebut) ? $stage->s_datedebut : '') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Durée du stage (en semaines)</label>
                <div class="col-md-2">
                    <input id="s_duree" name="s_duree" placeholder="Durée" class="form-control input-md" type="number" value="<?= (isset($stage->s_duree) ? $stage->s_duree : '1') ?>" min="1">
                </div>
            </div>
        </div>
        <?php endif; ?>
        
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Description</label>  
                <div class="col-md-8">
                    <textarea id="p_description" name="p_description" placeholder="Description du poste" class="form-control input-md" style="height:100px;" type="text" ><?= (isset($proposition->p_description) ? $proposition->p_description : '') ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Missions principales</label>  
                <div class="col-md-8">
                    <textarea id="p_missions" name="p_missions" placeholder="Missions du poste" class="form-control input-md" style="height:500px;" type="text" ><?= (isset($proposition->p_missions) ? $proposition->p_missions : '') ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Profil recherché</label>  
                <div class="col-md-8">
                    <textarea id="p_profil" name="p_profil" placeholder="Profil demandé pour le poste" class="form-control input-md" style="height:300px;" type="text" ><?= (isset($proposition->p_profil) ? $proposition->p_profil : '') ?></textarea>
                </div>
            </div>
        </div>
        <!-- durée, date debut, date de fin, avantages -->
        <?php if ($proposition->p_type == "S"): ?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Avantages (facultatif)</label>
                <div class="col-md-8">
                    <textarea id="s_avantages" name="s_avantages" placeholder="Avantages" class="form-control input-md" type="text"><?= (isset($stage->s_avantages) ? $stage->s_avantages : '') ?></textarea>
                </div>
            </div> 
        <?php endif; ?>

        <?php if ($proposition->p_type == "E"): ?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Nombre d'heures par semaine</label>
                <div class="col-md-2">
                    <input type="number" name="e_tempstravail" id="e_tempstravail" placeholder="1" class="form-control input-md" value="<?= (isset($emploi->e_tempstravail) ? $emploi->e_tempstravail : '') ?>" min="1" max="45">
                </div>        
            </div>
        </div>
        <?php endif; ?>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Informations supplémentaires (facultatif)</label>  
                <div class="col-md-8">
                    <textarea id="p_informationsupp" name="p_informationsupp" placeholder="" class="form-control input-md" style="height:90px;" type="text" ><?= (isset($proposition->p_informations) ? $proposition->p_informations : '') ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <input type="submit" name="Modifier" value='Modifier' class="col-md-5 btn btn-info">
        </div>
    </fieldset>
    <br><br>
</form>