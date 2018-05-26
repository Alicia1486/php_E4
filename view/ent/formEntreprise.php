<!-- Text input-->

<div class="form-group">
    <label class="col-md-2 control-label" for="textinput">Nom</label>  
    <div class="col-md-4">
        <input id="e_nom" name="e_nom" placeholder="Nom de l'entreprise" class="form-control input-md" type="text" value="<?php if($e_nom != ''){ echo $e_nom; }?>">

    </div>
</div>

<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="e_adresse1">Adresse</label>  
    <div class="col-md-5">
        <input id="e_adresse1" name="e_adresse1" placeholder="Adresse principale" title="Adresse  principale"  class="form-control input-md" type="text" value="<?php if($e_adresse1 != ''){ echo $e_adresse1; } ?>">

    </div>
</div>

<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="e_adresse2">Adresse (suite)</label>  
    <div class="col-md-4">
        <input id="e_adresse2" name="e_adresse2" placeholder="Complément d'adresse" class="form-control input-md" type="text" value="<?php if($e_adresse2 != ''){ echo $e_adresse2; } ?>">

    </div>
</div>
<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="e_codpostale">Code postal</label>  
    <div class="col-md-2">
        <input id="e_codpostal" name="e_codpostal" placeholder="Code postal" class="form-control input-md" type="text" value="<?php if($e_codpostal != ''){ echo $e_codpostal; } ?>">

    </div>
    <label class="col-md-2 control-label" for="e_ville">Ville</label>  
    <div class="col-md-4">
        <input id="e_ville" name="e_ville" placeholder="Ville" class="form-control input-md" type="text" value="<?php if($e_ville != ''){ echo $e_ville; } ?>">

    </div>
</div>
<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="e_nom_contact">Nom contact</label>  
    <div class="col-md-4">
        <input id="e_nom_contact" name="e_nom_contact" placeholder="Nom contact" class="form-control input-md" type="text" value="<?php if($e_nom_contact != ''){ echo $e_nom_contact; } ?>">

    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="e_tel">Téléphone</label>  
    <div class="col-md-4">
        <input id="e_tel" name="e_tel" placeholder="Téléphone" class="form-control input-md" type="text" value="<?php if($e_tel != ''){ echo $e_tel; } ?>">

    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="e_mail">Courriel</label>  
    <div class="col-md-4">
        <input id="e_mail" name="e_mail" placeholder="Courriel" class="form-control input-md" type="text" value="<?php if($e_mail != ''){ echo $e_mail; } ?>">

    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label" for="te_code">Type d'entreprise</label>  
    <div class="col-md-4">
        <select id="te_code" name="te_code" placeholder="Type d'entreprise" class="form-control input-md" type="text">

            <?php foreach ($type_entreprise as $te): ?>
                <?php
                $selected = "";
                if ($te_code != ''){ echo $te_code; } ?>
                }
                ?>
                <option value="<?= $te->te_code ?>" <?= $selected ?> ><?= $te->te_libelle ?></option>
            <?php endforeach; ?>
        </select> 

    </div>
</div>

