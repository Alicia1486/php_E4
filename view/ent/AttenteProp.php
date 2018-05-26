<section class="col-md-12 table_responsive">
    <h3><strong>Propositions en attente : <?= $nbPropositions ?></strong></h3>
    <hr>
    <div class='col-md-offset-8'>
        <p><img src="../webroot/img/Attention.png" width="20px"> = Non vérifié par l'établissement</p>
    </div><br>
    <div>
        <p style="color:green;"><?= $messageok ?></p>
    </div>
    <table class="table table-bordered table-condensed table-striped" id="liste_ent">
        <thead>
            <tr>
                <th class="<?= $role ?>">Code</th>
                <th>Type</th>
                <th>Intitulé</th>
                <th>Entreprise</th>
                <th>Localisation</th>
                <th>Description</th>
                <th class="<?= $role ?>">Accepter</th>
                <th class="<?= $role ?>">Refuser</th>
            </tr>
        </thead>
        <?php foreach ($propositions as $e): ?>
            <tr>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/affichProp/' . $e->p_code; ?>" 
                       title="Cliquez pour valider la proposition"><?php echo $e->p_code ?></a></td>
                
                <td value="<?php if ($e->p_type == "S"){ echo 'Stage'; } else { echo "Emploi";}?>"><?php if ($e->p_type == "S"){ echo 'Stage'; } else { echo "Emploi";}?></td>
                <td><?= $e->p_designation ?></td>
                <td><?php echo $e->e_nom; if ($e->e_acceptation == 0){ echo ' <img src="../webroot/img/Attention.png" width="20px">'; } ?></td>
                <td><?= $e->p_localisation ?></td>
                <td><?= $e->p_description ?></td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/accepterprop/' . $e->p_code; ?>"  class="btn btn-xs btn-success" title="Supprimer"><span class="glyphicon glyphicon-check"></span></a></td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/supprimerprop/' . $e->p_code; ?>"  class="btn btn-xs btn-danger" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>