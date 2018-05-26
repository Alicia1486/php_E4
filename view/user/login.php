
<?php
$title_for_layout = 'Connexion';
//  echo "insert into users (u_login,u_password) values ('claude','", sha1('claude'),"');"
?>
<div class="col-md-6">
    <form class="form-horizontal" method="post" action="<?= BASE_URL ?>/user/login" >
        <fieldset>

            <!-- Form Name -->
            <legend>Connexion</legend>
            <div class="form-group">
                <label class="col-md-2 control-label" for="textinput">Login</label>  
                <div class="col-md-12">
                    <input id="u_login" name="u_login" placeholder="Login" class="form-control input-md" type="text" >

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-2 control-label" for="u_password">Password</label>  
                <div class="col-md-12">
                    <input id="u_password" name="u_password" placeholder="Mot de passe" title="Mot de passe"  class="form-control input-md" type="password" >

                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="singlebutton"></label>
                <div class="col-md-12">
                    <button id="singlebutton" name="singlebutton" class="btn btn-info">Connexion</button>
                </div>
            </div>
        </fieldset>
    </form>
    <legend class="col-md-12"><?= $message ?></legend>
</div>