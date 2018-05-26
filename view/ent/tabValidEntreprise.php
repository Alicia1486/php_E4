<section class="col-sm-8 table_responsive">

    <table class="table table-bordered table-condensed table-striped" id="liste_ent">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Nom du contact</th>
                <th>Téléphone</th>
                <th>Mail</th>
                <th class="<?= $role ?>">Accepter</th>
                <th class="<?= $role ?>">Refuser</th>
            </tr>
        </thead>
        <?php foreach ($entreprises as $e): ?>
            <tr>
                <td><a href="<?php echo BASE_URL . '/ent/validEntreprise/' . $e->e_code; ?>" 
                       title="Cliquez pour valider l'entreprise"><?php echo $e->e_code ?></a></td>
                <td><?= $e->e_nom ?></td>
                <td><?= $e->e_nom_contact ?></td>
                <td><?= $e->e_tel ?></td>
                <td><?= $e->e_mail ?></td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/accepterEntreprise/' . $e->e_code; ?>"  class="btn btn-xs btn-success" title="Accepter"><span class="glyphicon glyphicon-check"></span></a></td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/supprimerEntreprise/' . $e->e_code; ?>"  class="btn btn-xs btn-danger" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
