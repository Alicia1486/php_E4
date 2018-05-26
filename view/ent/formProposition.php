<!-- Text input-->
<?php $title_for_layout = "Propositions" ?>
<form class="form-horizontal" method="post" action="<?= BASE_URL ?>/ent/formProposition/<?= $e_code ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Proposition</legend>
        <div class="col-lg-offset-10">
            <p><em> * = Obligatoire </em></p>
        </div>
        <p style="color:red"><?= $message ?></p>
        <p style="color:green"><?= $messageok ?></p>
        <div class='form-group'><br>
            <label class="col-md-3 control-label" for="type">Stage</label>
            <div class='col-md-3'>
                <input type='radio' name='type' class=' input-md' id="JSstage" value='S' <?php if($type == 'S'){ echo 'checked="checked"'; }?> onclick="affiche();">
            </div>
            <label class="col-md-3 control-label" for="type">Emploi</label>
            <div class="col-md-3">
                <input type="radio" name="type" class="input-md" id="JSemploi" value="E" <?php if($type == 'E'){ echo 'checked="checked"'; }?> onclick="affiche();">
            </div>
        </div><br>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-3 control-label" for="p_designation">Intitulé* </label>  
                <div class="col-md-8">
                    <input id="p_designation" name="p_designation" placeholder="PHP" class="form-control input-md" type="text" value="<?php if($designation != ''){ echo $designation; } ?>">
                </div>
            </div>
        </div>  
        <div id="propEmploi" style='display:none;' class='col-md-12'>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Type de contrat (CDI, CDD, ...)*</label>
                <div class="col-md-7">
                    <select name="e_contrat" id="e_contrat" class="form-control input-md">
                        <option value="CDI" <?php if($e_contrat == 'CDI'){ echo "selected='selected'"; } ?>>CDI – Contrat à durée indéterminée</option>
                        <option value="CDD" <?php if($e_contrat == 'CDD'){ echo "selected='selected'"; } ?>>CDD – Contrat à durée déterminée</option>
                        <option value="CTT" <?php if($e_contrat == 'CTT'){ echo "selected='selected'"; } ?>>CTT – Contrat de travail temporaire ou Intérim</option>
                        <option value="CA" <?php if($e_contrat == 'CA'){ echo "selected='selected'"; } ?>>Contrat d’apprentissage (alternance)</option>
                    </select>
                </div>        
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Localisation*</label>  
                <div class="col-md-8">
                    <input id="p_localisation" name="p_localisation" placeholder="Localisation du poste" class="form-control input-md" type="text" value="<?php if($localisation != ''){ echo $localisation; } ?>" >
                </div>
            </div>
        </div>
        <!-- durée, date debut, date de fin, avantages -->
        <div id="propStage" style='display:inline-block;' class='col-md-12'>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Date de début*</label>
                <div class="col-md-4">
                    <input type="date" name="s_datedebut" id="s_datedebut" class="form-control input-md" value="<?php if($datedebut != ''){ echo $datedebut; } ?>" placeholder="Jour/Mois/Annee">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Durée (en semaines)*</label>
                <div class="col-md-2">
                    <input id="s_duree" name="s_duree" placeholder="Durée" class="form-control input-md" type="number" value="<?php if($duree != 0){ echo $duree; } ?>" min="1" >
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Description*</label>  
                <div class="col-md-8">
                    <textarea id="p_description" name="p_description" placeholder="Description du poste"  style="height:100px;" class="form-control input-md" type="text" ><?php if($description != ''){ echo $description; } ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Missions principales*</label>  
                <div class="col-md-8">
                    <textarea id="p_missions" name="p_missions" placeholder="Missions du poste" class="form-control input-md" style="height:300px;" type="text" ><?php if($missions != ''){ echo $missions; } ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="description" required>Profil recherché*</label>  
                <div class="col-md-8">
                    <textarea id="p_profil" name="p_profil" placeholder="Profil demandé pour le poste" class="form-control input-md" style="height:200px;" type="text" ><?php if($profil != ''){ echo $profil; } ?></textarea>
                </div>
            </div>
        </div>
        <!-- durée, date debut, date de fin, avantages -->
        <div id="propStage2" style='display:inline-block;' class='col-md-12'>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Avantages</label>
                <div class="col-md-8">
                    <textarea id="s_avantages" name="s_avantages" placeholder="Avantages" class="form-control input-md" type="text" ><?php if($avantages != ''){ echo $avantages; } ?></textarea>
                </div>
            </div> 
        </div>

        <div id="propEmploi2" style='display:none;' class='col-md-12'>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description" required>Nombre d'heures par semaine*</label>
                <div class="col-md-2">
                    <input type="number" name="e_tempstravail" id="e_tempstravail" placeholder="1" class="form-control input-md" value="<?php if($e_tempstravail != 0){ echo $e_tempstravail; } ?>" min="1" max="45">
                </div>        
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Informations supplémentaires</label>  
                <div class="col-md-8">
                    <textarea id="p_informationsupp" name="p_informationsupp" placeholder="Contact - Renseignement à rajouter" class="form-control input-md" style="height:90px;" type="text" ><?php if($informations != ''){ echo $informations; } ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <label class="col-md-9 control-label" for="singlebutton"></label>
            <input type="submit" name="submit" value='Valider' class="btn btn-info col-md-3">
        </div>
    </fieldset>
    <br><br>
</form>