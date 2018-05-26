<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userController
 *
 * @author travail
 */
class UserController extends Controller {

//put your code here
    private $modUser = null;

    public function login() {
        $d['message'] = "Entrez votre login et votre mot de passe";
        
        if (isset($_POST['singlebutton'])) {
            if (is_null($this->modUser)) {
                $this->modUser = $this->loadModel('User');
            }

            $donnees = array();
//on n'envoie pas à la méthode update que les boutons où autres      
            foreach ($_POST as $k => $v) {
                if ($k != 'singlebutton') {
                    if ($k == 'u_password') {
                        $donnees[$k] = sha1($v);
                    } else {
                        $donnees[$k] = $v;
                    }
                }
            }
            $d['user'] = $this->modUser->findFirst(array(
                'conditions' => $donnees));
            
            if (empty($d['user'])) {
                $d['message'] = 'Login et/ou mot de passe  incorrects';
                Session::set('login', null);
            } else {
                $d['message'] = 'Bonjour ' . $d['user']->u_prenom . ' ' . $d['user']->u_nom;
                Session::set('login', $d['user']->u_login);
                Session::set('role', $d['user']->u_role);
                // echo 'session login',Session::get('login');
                //redirection vers l'écran d'accueil
                $this->redirect('/ent/liste');

                header("$url");
            }
        } else {
            if (is_null($this->modUser)) {
                $this->modUser = $this->loadModel('User');
            }
            $d['user'] = 'auto';
            Session::set('login', $d['user']);
        } 
        $this->set($d);
    }
    
    public function logout() {
        
    }

}
