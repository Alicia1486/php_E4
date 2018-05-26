<?php $title_for_layout = "Propositions" ?>
<section class="col-md-12 table_responsive">
    <h3><strong>Proposition de <?php
            if ($proposition->p_type == "S") {
                echo 'Stage';
            } else {
                echo "Emploi";
            }
            ?> par l'entreprise : <?php echo $proposition->e_nom ?></strong></h3>
    
    <form method="POST" action="<?= BASE_URL ?>/ent/detail/<?= $proposition->e_code; ?>"
    
    <br><hr><br>
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-4 control-label" for="p_designation">Intitulé :</label>  
            <div class="col-md-4">
                <?php
                if ($proposition->p_designation != '') {
                    echo $proposition->p_designation;
                }
                ?>
            </div>
        </div> 

        <br>
    </div>
    <?php if ($proposition->p_type == "E"): ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Type de contrat :</label>
                <div class="col-md-7">
                    <?php
                    if ($emploi->e_contrat == "CDI") {
                        echo "CDI - Contrat à durée indéterminée";
                    } elseif ($emploi->e_contrat == "CDD") {
                        echo "CDD - Contrat à durée déterminée";
                    } elseif ($emploi->e_contrat == "CTT") {
                        echo "CTT - Contrat de travail temporaire";
                    } else {
                        echo "Contrat d'apprentissage (alternative)";
                    };
                    ?>
                </div>        
            </div>

            <br>
        </div>
    <?php endif; ?>
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Localisation : </label>  
            <div class="col-md-4">
                <?php
                if ($proposition->p_localisation != '') {
                    echo $proposition->p_localisation;
                }
                ?>
            </div>
        </div>

        <br>
    </div>
    <!-- durée, date debut, date de fin, avantages -->
    <?php if ($proposition->p_type == "S"): ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Date de début : </label>
                <div class="col-md-7">
                    <?= (isset($stage->s_datedebut) ? $stage->s_datedebut : '') ?>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Durée du stage :</label>
                <div class="col-md-7">
                    <?= (isset($stage->s_duree) ? $stage->s_duree : '1') ?>
                </div>
            </div>

            <br>
        </div>
    <?php endif; ?>
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Description : </label>  
            <div class="col-md-7">
                <?= (isset($proposition->p_description) ? $proposition->p_description : '') ?>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Missions principales : </label>  
            <div class="col-md-7">
                <?= (isset($proposition->p_missions) ? $proposition->p_missions : '') ?>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Profil recherché : </label>  
            <div class="col-md-7">
                <?= (isset($proposition->p_profil) ? $proposition->p_profil : '') ?>
            </div>
        </div>

        <br>
    </div>
    <!-- durée, date debut, date de fin, avantages -->
    <?php if ($proposition->p_type == "S"): ?>
    <?php if ($stage->s_avantages != ''): ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Avantages : </label>
                <div class="col-md-7">
                    <?= (isset($stage->s_avantages) ? $stage->s_avantages : '') ?>
                </div>
            </div> 

            <br>
        </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php if ($proposition->p_type == "E" ): ?>
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Nombre d'heures par semaine : </label>
                <div class="col-md-7">
                    <?= (isset($emploi->e_tempstravail) ? $emploi->e_tempstravail : '') ?>
                </div>        
            </div>

            <br>
        </div>
    <?php endif; ?>
    <?php if($proposition->p_informations != ''): ?>
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-4 control-label" for="description">Informations supplémentaires : </label>  
            <div class="col-md-7">
                <?= (isset($proposition->p_informations) ? $proposition->p_informations : '') ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-12">
        <br><br>
            <label class="col-md-4 control-label" for="singlebutton"></label>
            <input type="submit" name="" value="Pour contacter l'entreprise" class="col-md-5 btn btn-info">
        </div>
</section>