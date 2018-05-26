<section class="col-sm-8 table_responsive">
  
    <table class="table table-bordered table-condensed table-striped" id="liste_ent">
        <thead>
            <tr>
                <th>Nom</th>
                <th class="hidden-xs">Adresse</th>
                <th>Code postal</th>
                <th>Contact</th>
                <th>Téléphone</th>
                <th>Couriel</th>
                <th>Type Entreprise</th>
                <th class="<?= $role ?>">Supprimer</th>

            </tr>
        </thead>
        <?php foreach ($entreprises as $e): ?>
            <tr>
                <td><a href="<?php echo BASE_URL . '/ent/detail/' . $e->e_code; ?>" 
                       title="Cliquez pour modifier"><?php echo $e->e_nom ?></a></td>
                <td class="hidden-xs"><?= $e->e_adresse1 ?></td>
                <td><?= $e->e_codpostal ?></td>
                <td><?= $e->e_nom_contact ?></td>
                <td><?= $e->e_tel ?></td>
                <td><?= $e->e_mail ?></td>
                <td>
                    <?php
                    foreach ($type_entreprise as $te) {
                        if ($e->te_code === $te->te_code) {
                            echo $te->te_libelle;
                        }
                    }
                    ?>
                </td>
                <td class="<?= $role ?>"><a href="<?php echo BASE_URL . '/ent/supprimer/' . $e->e_code; ?>"  class="btn btn-xs btn-danger" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        <?php endforeach; ?>
    </table>
</section>
