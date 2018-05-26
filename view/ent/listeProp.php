<section class="col-md-12 table_responsive">
    <h3><strong>Propositions : <?= $nbPropositions ?></strong></h3>
    <hr><br>
    <div>
        <p style="color:green;"><?= $messageok ?></p>
    </div>
    <table class="table table-bordered table-condensed table-striped" id="liste_ent">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Type</th>
                <th>Entreprise</th>
                <th>Localisation</th>
                <th>Description</th>
                <th>Profil</th>
                <th class="<?= $role ?>">Refuser</th>
            </tr>
        </thead>
        <?php foreach ($propositions as $e): ?>
            <tr>
                <td><a href="<?php echo BASE_URL . '/ent/detailProp/' . $e->p_code; ?>" 
                       title="Cliquez pour voir la proposition"><?php echo $e->p_designation ?></a></td>
                
                <td value="<?php if ($e->p_type == "S"){ echo 'Stage'; } else { echo "Emploi";}?>"><?php if ($e->p_type == "S"){ echo 'Stage'; } else { echo "Emploi";}?></td>
                <td><?= $e->e_nom ?></td>
                <td><?= $e->p_localisation ?></td>
                <td><?= $e->p_description ?></td>
                <td><?= $e->p_profil ?></td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/supprimerprop/' . $e->p_code; ?>"  class="btn btn-xs btn-danger" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>