<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="textinput">Texte</label>  
    <div class="col-md-10">
        <textarea id="c_texte" name="c_texte" placeholder="Entrer votre commentaire" class="form-control input-md" type="text" >
        </textarea>
    </div>
</div>

<!-- Text input-->
<div class="form-group">
    <label class="col-md-2 control-label" for="c_type">Type</label>  
    <div class="col-md-2">
        <select id="c_type" name="c_type" placeholder="Type de commentaire" title="Type de votre commentaire"  class="form-control input-md" >
            <option>Couriel</option>
            <option>Téléphone</option>
            <option>Courrier</option>
            <option>A modifier</option>
        </select>

    </div>
</div>

<!--div class="form-group">
    <label class="col-md-2 control-label" for="te_code">Type d'entreprise</label>  
    <div class="col-md-4">
        <select id="te_code" name="te_code" placeholder="Type d'entreprise" class="form-control input-md" type="text">

            <?php foreach ($type_entreprise as $te): ?>
                <?php
                $selected = "";
                if ($entreprise->te_code === $te->te_code) {
                    $selected = "selected";
                }
                ?>
                <option value="<?= $te->te_code ?>" <?= $selected ?> ><?= $te->te_libelle ?></option>
<?php endforeach; ?>
        </select> 

    </div>
</div-!>

