<?php

class EntController extends Controller {

    private $modEntreprise = null;
    private $modType_Entreprise = null;
    private $modCommentaire = null;

//put your code here
    function liste() {

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }

        //**************************************************************************
        //***************************************************************************
        //***************************************************************************
        $d['entreprises'] = $this->modEntreprise->find(array('conditions' => array('e_acceptation' => 1)));
        //***************************************************************************
        //***************************************************************************
        if (empty($d['entreprises'])) {
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        $this->set($d);
    }

    function detail($id) {
        $id = $id[0];

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprise'] = $this->modEntreprise->findFirst(array(
            'conditions' => array('e_code' => $id)
        ));
        if (empty($d['entreprise'])) {
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $d['commentaires'] = $this->modCommentaire->find(array(
            'conditions' => array('e_code' => $id)
        ));
        $this->set($d);
    }

    function supprimer($id) {
        $id = $id[0];
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $this->name->delete(array(
            'conditions' => array('e_code' => $id)
        ));
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $this->name->delete(array(
            'conditions' => array('e_code' => $id)
        ));
//on réaffiche la liste des entreprises
        $this->liste();
    }

    function ajoutcom($id) {
        $id = $id[0];
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire');
        }
        $colonnes = array('c_login', 'c_dateheure', 'c_texte', 'c_type', 'e_code');
        $donnees = array(SESSION::get('login'), date('y/m/d G:i:s'), $_POST['c_texte'], $_POST['c_type'], $id);

        $c_code = $this->modCommentaire->insertAI($colonnes, $donnees);


        $d['commentaires'] = $this->modCommentaire->find(array(
            'conditions' => array('e_code' => $id))
        );

        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprise'] = $this->modEntreprise->findFirst(array(
            'conditions' => array('e_code' => $id)
        ));
        if (empty($d['entreprise'])) {
            $this->e404('Page introuvable');
        }

        $this->set($d);
    }

    function modifier($id) {
        $id = $id[0];
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }

        $donnees = array();
//on n'envoie pas à la méthode update que les boutons où autres      
        foreach ($_POST as $k => $v) {
            if ($k != 'singlebutton') {
                $donnees[$k] = $v;
            }
        }

        $tab = array();
        $tab = array(
            'cle' => array('e_code' => $id),
            'donnees' => $donnees);

        $this->modEntreprise->update($tab);


//on réaffiche la liste des entreprises

        $this->liste();
    }

    function nouveau() {
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        $this->set($d);
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $verif = '';

        $d['e_nom'] = '';
        $d['e_adresse1'] = '';
        $d['e_adresse2'] = '';
        $d['e_ville'] = '';
        $d['e_codpostal'] = '';
        $d['e_nom_contact'] = '';
        $d['e_tel'] = '';
        $d['e_mail'] = '';
        $d['te_code'] = '';

        if (isset($_POST['submit'])) {
            $valid = true;
            //Recuperer les données
            $e_nom = $_POST['e_nom'];
            $e_adresse1 = $_POST['e_adresse1'];
            $e_adresse2 = $_POST['e_adresse2'];
            $e_ville = $_POST['e_ville'];
            $e_codpostal = $_POST['e_codpostal'];
            $e_nom_contact = $_POST['e_nom_contact'];
            $e_tel = $_POST['e_tel'];
            $e_mail = $_POST['e_mail'];
            $te_code = $_POST['te_code'];
            $e_login = '';
            $length_CP = strlen($e_codpostal);
            $length_tel = strlen($e_tel);
            //instancier les données rentrées
            $d['e_nom'] = $e_nom;
            $d['e_adresse1'] = $e_adresse1;
            $d['e_adresse2'] = $e_adresse2;
            $d['e_ville'] = $e_ville;
            $d['e_codpostal'] = $e_codpostal;
            $d['e_nom_contact'] = $e_nom_contact;
            $d['e_tel'] = $e_tel;
            $d['e_mail'] = $e_mail;
            $d['te_code'] = $te_code;
            //verifications
            if (empty($e_nom)) {
                $valid = false;
                $verif = $verif . "Veuillez entrer le nom de l'entreprise. <br>";
            }
            if (empty($e_adresse1)) {
                $valid = false;
                $verif = $verif . "Veuillez entrer l'adresse de l'entreprise.<br>";
            }
            if (empty($e_ville)) {
                $valid = false;
                $verif = $verif . "Veuillez entrer la ville de l'entreprise. <br>";
            }
            if (empty($e_codpostal) || !(preg_match('^[0-9]{2,}$^', $e_codpostal) || ($length_CP != 5))) {
                $valid = false;
                $verif = $verif . "Veuillez entrer le code postal de l'entreprise. <br>";
            }
            if (empty($e_nom_contact)) {
                $valid = false;
                $verif = $verif . "Veuillez entrer la personne de l'entreprise à contacter. <br>";
            }
            if (empty($e_tel) || $length_tel < 10 || $length_tel > 14) { //|| !(preg_match('`[0-9]{10}`',$e_tel
                $valid = false;
                $verif = $verif . "Veuillez entrer un numéro de téléphone valide. <br>";
            }
            if (empty($e_mail) || !(filter_var($e_mail, FILTER_VALIDATE_EMAIL)) || !(preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $e_mail))) {
                $valid = false;
                $verif = $verif . "Email non valide. <br>";
            }
            if (empty($te_code)) {
                $valid = false;
                $verif = $verif . "Veuillez choisir le type de l'entreprise. <br>";
            }
            //si les vérifications sont bonnes
            if ($valid == true) {
                //inserer les données dans les variables
                $colonnes = array('e_nom', 'e_adresse1', 'e_adresse2', 'e_ville', 'e_codpostal', 'e_nom_contact', 'e_tel', 'e_mail', 'te_code', 'e_login');
                $donnees = array($e_nom, $e_adresse1, $e_adresse2, $e_ville, $e_codpostal, $e_nom_contact, $e_tel, $e_mail, $te_code, $e_login);

                $e_code = $this->modEntreprise->insertAI($colonnes, $donnees); //faire l'insert
                $verif = 'Entreprise enregistrée ! '; //afficher un message
                $d['entreprise'] = $this->modEntreprise->findFirst(array('conditions' => array('e_code' => $e_code))); //afficher l'entreprise
            }
        }
        $d['message'] = $verif; //afficher le message
        $this->set($d); //afficher la vue
    }

    function creer() {
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }

        $donnees = array();
        $colonnes = array();
//on n'envoie pas à la méthode insert  les boutons où autres      
        foreach ($_POST as $k => $v) {
            if ($k != 'singlebutton') {
                $donnees[] = $v;
                $colonnes[] = $k;
            }
        }
        $donnees[] = SESSION::get('login');
        $colonnes[] = 'e_login';


        $id = $this->modEntreprise->insertAI($colonnes, $donnees);
        //on réaffiche l'entreprise crée
        $this->detail(array($id));
    }

    function render($view) {
        if ($view === 'supprimer' || $view === 'modifier' || $view === 'modifier_entreprise') {
            parent:: render('liste');
        } elseif ($view == 'creer' || $view == 'ajoutcom') {
            parent:: render('detail');
        } elseif ($view == 'creerproposition') {
            parent::render('formproposition');
        } elseif ($view == 'supprimerprop' || $view == 'accepterprop') {
            parent::render('AttenteProp');
        } elseif ($view == 'validProp') {
            parent::render('affichProp');
        } elseif ($view == 'supprimerEntreprise' || $view == 'accepterEntreprise') {
            parent::render('tabValidEntreprise');
        } elseif ($view == 'modifierEntreprise') {
            parent::render('validEntreprise');
        } else {
            parent:: render($view);
        }
    }

    function tabValidEntreprise() {
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprises'] = $this->modEntreprise->find(array('conditions' => array('e_acceptation' => 0)));
        if (empty($d['entreprises'])) {
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise');
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1)
        );
        $this->set($d);
    }

    function validEntreprise($id) {
        $id = $id[0];
        $d['message'] = '';
        $d['messageok'] = '';
        
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise');
        }
        $d['entreprise'] = $this->modEntreprise->findFirst(array(
            'conditions' => array('e_code' => $id) //afficher les entreprises par leur id
        ));
        if (empty($d['entreprise'])) { //si la base de données est vide
            $this->e404('Page introuvable');
        }
        if (is_null($this->modType_Entreprise)) {
            $this->modType_Entreprise = $this->loadModel('Type_Entreprise'); //charger le modele type entreprise
        }
        $d['type_entreprise'] = $this->modType_Entreprise->find(array(
            'conditions' => 1) //afficher les types entreprises
        );

        if (isset($_POST['submit'])) {
            //recuperation des données
            $e_code = $id;
            $d['message'] = '';
            $e_nom = $_POST['e_nom'];
            $e_adresse1 = $_POST['e_adresse1'];
            $e_adresse2 = $_POST['e_adresse2'];
            $e_ville = $_POST['e_ville'];
            $e_codpostal = $_POST['e_codpostal'];
            $e_nom_contact = $_POST['e_nom_contact'];
            $e_tel = $_POST['e_tel'];
            $e_mail = $_POST['e_mail'];
            $te_code = $_POST['te_code'];
            $e_login = '';
            //récuperer la longueur
            $length_CP = strlen($e_codpostal);
            $length_tel = strlen($e_tel);
            //variables verifications
            $verif = '';
            $valid = true;

            if (empty($e_nom)) { //Si le nom est vide
                $valid = false;
                $verif = $verif . "Veuillez entrer le nom de l'entreprise. <br>";
            }
            if (empty($e_adresse1)) { //Si l'adresse est vide
                $valid = false;
                $verif = $verif . "Veuillez entrer l'adresse de l'entreprise.<br>";
            }
            if (empty($e_ville)) { //Si la ville est vide
                $valid = false;
                $verif = $verif . "Veuillez entrer la ville de l'entreprise. <br>";
            }
            if (empty($e_codpostal) || !(preg_match('^[0-9]{2,}$^', $e_codpostal)) || ($length_CP != 5)) { //Si le code postal est vide ou ne contient pas que des chiffres ou a une longueur différente de 5
                $valid = false;
                $verif = $verif . "Veuillez entrer le code postal de l'entreprise. <br>";
            }
            if (empty($e_nom_contact)) { //si le nom de contact est vide
                $valid = false;
                $verif = $verif . "Veuillez entrer la personne de l'entreprise à contacter. <br>";
            }
            if (empty($e_tel) || $length_tel < 10 || $length_tel > 14) { //si le telephone est vide ou a une longueur inférieure à 10 ou supérieure à 14 (pour les espaces)       
                $valid = false;
                $verif = $verif . "Veuillez entrer un numéro de téléphone valide. <br>";
            }
            if (empty($e_mail) || !(filter_var($e_mail, FILTER_VALIDATE_EMAIL)) || !(preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $e_mail))) { //Si l'email est vide ou ne contient pas d'arobaze ni de point
                $valid = false;
                $verif = $verif . "Email non valide. <br>";
            }
            if (empty($te_code)) { //si le te_code est vide
                $valid = false;
                $verif = $verif . "Veuillez choisir le type de l'entreprise. <br>";
            }

            if ($valid == true) { //Si la donnée valid est égale à true
                //charger le modèle nécessaire : Entreprise
                $modEntreprise = $this->loadModel('Entreprise');
                //faire un tableau
                $donnees = array();
                //données à modifier
                $donnees['e_nom'] = $_POST['e_nom'];
                $donnees['e_adresse1'] = $_POST['e_adresse1'];
                $donnees['e_adresse2'] = $_POST['e_adresse2'];
                $donnees['e_ville'] = $_POST['e_ville'];
                $donnees['e_codpostal'] = $_POST['e_codpostal'];
                $donnees['e_nom_contact'] = $_POST['e_nom_contact'];
                $donnees['e_tel'] = $_POST['e_tel'];
                $donnees['e_mail'] = $_POST['e_mail'];
                $donnees['e_acceptation'] = 0;
                $donnees['te_code'] = $_POST['te_code'];
                //recuperer le code
                $cle = array();
                $cle['e_code'] = $e_code;
                $tab = array();
                $tab['cle'] = $cle;
                $tab['donnees'] = $donnees;
                //appelle methode udpate et remplace les données
                $modEntreprise->update($tab);
                $d['entreprises'] = $donnees;
                $d['messageok'] = "Entreprise bien modifiée";
                
                $d['entreprise'] = $this->modEntreprise->findFirst(array('conditions' => array('e_code' => $id)));
            }
            $d['message'] = $verif; //affichae du message de vérifications
        }
        $this->set($d); //afficher la vue
    }

    function accepterEntreprise($id) {
        $e_code = $id[0];

        $donnees = array();
        $modEntreprise = $this->loadModel('Entreprise'); //charger le modèle Entreprise
        //udpate
        //données à modifier
        $donnees['e_acceptation'] = 1;

        $cle = array();
        $cle['e_code'] = $e_code;
        $tab = array();
        $tab['cle'] = $cle;
        $tab['donnees'] = $donnees;
        //appelle methode udpate du tournoi
        $modEntreprise->update($tab);
        $d['entreprises'] = $donnees;
        $this->tabValidEntreprise($e_code); //afficher tabValidEntreprise
        //}
    }

    function supprimerEntreprise($id) {
        $e_code = $id[0]; //recupere l'id de l'entreprise
        if (is_null($this->modEntreprise)) {
            $this->modEntreprise = $this->loadModel('Entreprise'); //charger le modele Entreprise
        }
        if (is_null($this->modCommentaire)) {
            $this->modCommentaire = $this->loadModel('Commentaire'); //charger le modele Commentaire
        }

        $this->modCommentaire->delete(array(
            'conditions' => array('e_code' => $e_code) //supprimer la ligne avec $e_code
        ));

        $this->modEntreprise->delete(array(
            'conditions' => array('e_code' => $e_code) //supprimer l'entreprise
        ));
        $this->tabValidEntreprise(); //afficher tabValidEntreprise à la fin de la requete
    }

    function proposition() {
        $donnees = ''; //Initialiser à vide
        //Charger les models qu'on a besoin
        $modEntreprises = $this->loadModel('Entreprise');
        $modType_Entreprise = $this->loadModel('Type_Entreprise');
        //Requête SQL
        $d['entreprises'] = $modEntreprises->find(array('conditions' => 1));
        $d['type_entreprise'] = $modType_Entreprise->find(array('conditions' => 1));


        //on n'envoie pas à la méthode update que les boutons où autres      
        foreach ($_POST as $k => $v) {
            if ($k != 'singlebutton') {
                $donnees = $v;
            }
        }

        //Requête SQL ~ après l'execution du formulaire
        $d['entreprise'] = $modEntreprises->findFirst(array('conditions' => array('e_code' => $donnees)));
        $d['type'] = $modType_Entreprise->findFirst(array('conditions' => array('te_code' => $donnees)));
        $d['cle'] = $donnees;
        $this->set($d);
    }

    function formProposition($id) {
        //récuperer l'id dans le url + initialiser toutes les variables à vide
        $d['e_code'] = $id[0];
        $d['designation'] = '';
        $d['proposition'] = '';
        $d['localisation'] = '';
        $d['description'] = '';
        $d['missions'] = '';
        $d['profil'] = '';
        $d['informations'] = '';
        $d['duree'] = 0;
        $d['datedebut'] = '';
        $d['avantages'] = '';
        $d['type'] = 'S';
        $d['e_tempstravail'] = '';
        $d['e_contrat'] = 'CDI';

        $d['message'] = '';
        $d['messageok'] = '';

        //Quand l'utilisateur a cliqué sur le bouton submit
        if (isset($_POST['submit'])) {
            // Re-récupère l'id dans l'url
            $e_code = $id[0];
            //On recharge les models
            $modEntreprises = $this->loadModel('Entreprise');
            $modPropositions = $this->loadModel('Proposition');
            $modStages = $this->loadModel('Stage');
            $modEmplois = $this->loadModel('Emploi');

            //Rechercher les données
            $valid = true;
            $message = '';
            $messageok = '';
            $type = $_POST['type'];
            $designation = $_POST['p_designation'];
            $localisation = $_POST['p_localisation'];
            $description = $_POST['p_description'];
            $missions = $_POST['p_missions'];
            $profil = $_POST['p_profil'];
            $informations = $_POST['p_informationsupp'];

            //Pour pouvoir les réafficher dans la vue
            $d['type'] = $type;
            $d['designation'] = $designation;
            $d['localisation'] = $localisation;
            $d['description'] = $description;
            $d['missions'] = $missions;
            $d['profil'] = $profil;
            $d['informations'] = $informations;

            //Créer la clef primaire
            //Verifier pour eviter les accents et les remplacer
            $debutcode = str_replace(' ', '', $designation);
            $debutcode = preg_replace('#Ç#', 'C', $debutcode);
            $debutcode = preg_replace('#ç#', 'c', $debutcode);
            $debutcode = preg_replace('#è|é|ê|ë#', 'e', $debutcode);
            $debutcode = preg_replace('#È|É|Ê|Ë#', 'E', $debutcode);
            $debutcode = preg_replace('#à|á|â|ã|ä|å#', 'a', $debutcode);
            $debutcode = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $debutcode);
            $debutcode = preg_replace('#ì|í|î|ï#', 'i', $debutcode);
            $debutcode = preg_replace('#Ì|Í|Î|Ï#', 'I', $debutcode);
            $debutcode = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $debutcode);
            $debutcode = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $debutcode);
            $debutcode = preg_replace('#ù|ú|û|ü#', 'u', $debutcode);
            $debutcode = preg_replace('#Ù|Ú|Û|Ü#', 'U', $debutcode);
            $debutcode = preg_replace('#ý|ÿ#', 'y', $debutcode);
            $debutcode = preg_replace('#Ý#', 'Y', $debutcode);
            $p_code = substr($debutcode, 0, 5) . $e_code . $type; //Créer la clef primaire
            $p_code = strtoupper($p_code); //Le mettre en majuscule
            //Si la proposition est un stage 
            if ($type == 'S') {
                //Récupère les données de stage
                $duree = $_POST['s_duree'];
                $datedebut = $_POST['s_datedebut'];
                $avantages = $_POST['s_avantages'];

                //Pour pouvoir les réafficher dans la vue
                $d['duree'] = $duree;
                $d['datedebut'] = $datedebut;
                $d['avantages'] = $avantages;
            } else if ($type == 'E') { //Si c'est la proposition est un emploi
                //Récupère les données de emploi
                $e_tempstravail = $_POST['e_tempstravail'];
                $e_contrat = $_POST['e_contrat'];

                //Pour pouvoir les réafficher dans la vue
                $d['e_tempstravail'] = $e_tempstravail;
                $d['e_contrat'] = $e_contrat;
            }

            //Verifier si données n'est pas vide;
            if (empty($designation)) {
                $valid = false;
                $message = "<br> Le nom est obligatoire";
            }
            if (empty($localisation)) {
                $valid = false;
                $message = $message . "<br> Le lieu est obligatoire";
            }
            if (empty($description)) {
                $valid = false;
                $message = $message . "<br> La description du poste est obligatoire";
            }
            if (empty($missions)) {
                $valid = false;
                $message = $message . "<br> Les missions sont à décrire. ";
            }
            if (empty($profil)) {
                $valid = false;
                $message = $message . "<br> Le profil du poste est à décrire. ";
            }
            if ($type == 'S') {
                if (empty($duree)) {
                    $valid = false;
                    $message = $message . "<br> La durée du stage est obligatoire. ";
                }
            } else if ($type == 'E') {
                if (empty($e_tempstravail)) {
                    $valid = false;
                    $message = $message . "<br> Le temps de travail pour l'emploi est obligatoire. ";
                }
            }

            //Verifier les validité des données
            if ($valid == true) {
                $lgdesignation = strlen($designation);
                if ($lgdesignation > 50) {
                    $valid = false;
                    $message = $message . "<br> Le nom est trop long. Veuillez réduire le nom.";
                }

                $lglocalisation = strlen($localisation);
                if ($lglocalisation > 100) {
                    $valid = false;
                    $message = $message . "<br> La localisation n'est pas valide, elle doit être inférieur à 100 caractères";
                }

                //Verifier les données si c'est un stage
                if ($type == 'S') {
                    if (!ctype_digit($duree)) {
                        $valid = false;
                        $message = $message . "<br> La durée n'est pas correct, veuillez insérer un nombre.";
                    }
                    //Verifier date
                    $position = strpos($datedebut, "-");
                    if ($position === false) {
                        list($jour, $mois, $annee) = explode("/", $datedebut);
                    } else {
                        list($annee, $mois, $jour) = explode("-", $datedebut);
                    }
                    if ($jour > 31 || $jour < 1) {
                        $valid = false;
                        $message = $message . "<br> Le jour doit être compris entre 1 et 31.";
                    }
                    if ($mois < 1 || $mois > 12) {
                        $valid = false;
                        $message = $message . "<br> Le mois doit être compris entre 1 et 12.";
                    }
                    if (strlen($annee) < 4 || strlen($annee) > 4) {
                        $valid = false;
                        $message = $message . "<br> L'année doit avoir au moins 4 chiffres.";
                    }
                    if ($valid == true) {
                        $datedebut = $annee . "-" . $mois . "-" . $jour;
                        $message = $datedebut;
                    }
                } else if ($type == 'E') { //Si c'est un emploi
                    if (!ctype_digit($e_tempstravail)) {
                        $valid = false;
                        $message = $message . "<br> La durée n'est pas correct, veuillez insérer un nombre.";
                    }
                }
            }

            // Si tout est ok alors on lance les requêtes
            if ($valid == true) {
                //3 requêtes
                //Pour la table propositions
                $colonnes = array('p_code', 'e_code', 'p_designation', 'p_localisation', 'p_description', 'p_missions', 'p_type', 'p_profil', 'p_informations', 'p_acceptation');
                $donnees = array($p_code, $e_code, $designation, $localisation, $description, $missions, $type, $profil, $informations, 0);

                $modPropositions->insertAI($colonnes, $donnees);

                //Si la proposition est un stage 
                if ($type == 'S') {
                    //Pour la table stages 
                    $colonnes = array('p_code', 's_duree', 's_datedebut', 's_avantages');
                    $donnees = array($p_code, $duree, $datedebut, $avantages);

                    $modStages->insertAI($colonnes, $donnees);
                } else if ($type == 'E') {
                    //Ou pour la table emplois
                    $colonnes = array('p_code', 'e_tempstravail', 'e_contrat');
                    $donnees = array($p_code, $e_tempstravail, $e_contrat);

                    $modEmplois->insertAI($colonnes, $donnees);
                }
                //Initialisation du message pour la vue quand les requêtes se sont faîtes
                $messageok = "Proposition envoyée.";
            }
            $d['messageok'] = $messageok;
            $d['message'] = $message;
        }
        $this->set($d);
    }

    function AttenteProp() {
        $d['messageok'] = ""; //Initialisation message à vide
        //Charger le modèle 
        $modPropEnts = $this->loadModel('PropEnt');

        //Requête de toutes les propositions en attente avec acceptation = 0
        $d['propositions'] = $modPropEnts->find(array('conditions' => array('p_acceptation' => 0)));

        //Compter le nombre de propositions en attentes.
        $d['nbPropositions'] = (count($d['propositions']));
        $this->set($d);
    }

    function supprimerprop($id) {
        //récupère l'id dans l'url
        $id = $id[0];
        $d['messageok'] = 'Proposition bien supprimée.'; //Initialisation d'un message
        //Charger les models
        $this->modPropositions = $this->loadModel('Proposition');
        $this->modEmplois = $this->loadModel('Emploi');
        $this->modStages = $this->loadModel('Stage');


        //Supprimer la proposition
        $this->modEmplois->delete(array(
            'conditions' => array('p_code' => $id)
        ));

        //Supprimer si c'est un stage
        $this->modStages->delete(array(
            'conditions' => array('p_code' => $id)
        ));

        //Supprimer si c'est un emploi
        $this->modPropositions->delete(array(
            'conditions' => array('p_code' => $id)
        ));

        $this->set($d);
        //on réaffiche la liste des entreprises
        $this->AttenteProp();
    }

    function accepterprop($id) {
        //récupère l'id dans l'url
        $id = $id[0];
        $d['messageok'] = 'Proposition bien acceptée.'; //Initialisation d'un message
        //Charger le model
        $this->modPropositions = $this->loadModel('Proposition');

        $donnees = array(); //Tableau initialiser
        $donnees['p_acceptation'] = 1; //Mettre la p_acceptation dans le tableau

        $cle = array(); //Tableau initialiser
        $cle['p_code'] = $id; //Mettre la p_code dans le tableau

        $tab = array();
        $tab['cle'] = $cle;
        $tab['donnees'] = $donnees;

        //Faire la mise à jour
        $this->modPropositions->update($tab);

        $this->set($d);
        //Réafficher le tableau attente
        $this->AttenteProp();
    }

    function affichProp($id) {
        //récupère l'id dans l'url
        $d['e_code'] = $id[0];
        $p_code = $id[0];

        //Initialiser les variables à vide
        $d['message'] = '';
        $d['messageok'] = '';

        //Charger les models
        $modPropEnt = $this->loadModel('PropEnt');
        $modEmploi = $this->loadModel('Emploi');
        $modStage = $this->loadModel('Stage');

        //Requêtes SQL selon la selection
        $d['proposition'] = $modPropEnt->findFirst(array('conditions' => array('p_code' => $p_code)));
        $d['emploi'] = $modEmploi->findFirst(array('conditions' => array('p_code' => $p_code)));
        $d['stage'] = $modStage->findFirst(array('conditions' => array('p_code' => $p_code)));
        $type = $d['proposition']->p_type; //Récuperer le p_type 
        //Si c'est un stage
        if ($type == "S") {
            //Modifier la date pour la remettre au bon format
            $datedebut = $d['stage']->s_datedebut;
            list($annee, $mois, $jour) = explode("-", $datedebut);
            $datedebut = $jour . '/' . $mois . '/' . $annee;
        }
        $this->set($d);
    }

    function validProp($id) {
        //récupère l'id dans l'url
        $d['e_code'] = $id[0];
        $p_code = $id[0];

        //Initialiser les variables à vide
        $message = '';
        $messageok = '';
        $d['messageok'] = '';
        $d['message'] = '';
        $valid = true; //Variable booléan
        //Charger les models
        $modPropositions = $this->loadModel('Proposition');
        $modStages = $this->loadModel('Stage');
        $modEmplois = $this->loadModel('Emploi');
        $modPropEnt = $this->loadModel('PropEnt');

        //Rechercher les données
        $donnees = array();
        $donnees['p_designation'] = $_POST['p_designation'];
        $donnees['p_localisation'] = $_POST['p_localisation'];
        $donnees['p_description'] = $_POST['p_description'];
        $donnees['p_missions'] = $_POST['p_missions'];
        $donnees['p_profil'] = $_POST['p_profil'];
        $donnees['p_informations'] = $_POST['p_informationsupp'];

        //Pour pouvoir les vérifier
        $designation = $_POST['p_designation'];
        $localisation = $_POST['p_localisation'];
        $description = $_POST['p_description'];
        $missions = $_POST['p_missions'];
        $profil = $_POST['p_profil'];
        $informations = $_POST['p_informationsupp'];

        //Requête SQL
        $d['propositions'] = $modPropositions->findFirst(array('conditions' => array('p_code' => $p_code)));
        $type = $d['propositions']->p_type; //Récuperer la donnée type pour savoir si c'est un emploi ou un stage
        //Si la proposition est un stage 
        if ($type == 'S') {
            //Chercher les données
            $donnees2 = array();
            $donnees2['s_duree'] = $_POST['s_duree'];
            $donnees2['s_datedebut'] = $_POST['s_datedebut'];
            $donnees2['s_avantages'] = $_POST['s_avantages'];

            $duree = $_POST['s_duree'];
            $datedebut = $_POST['s_datedebut'];
            $avantages = $_POST['s_avantages'];
        } else if ($type == 'E') {
            //Chercher les données
            $donnees3 = array();
            $donnees3['e_tempstravail'] = $_POST['e_tempstravail'];
            $donnees3['e_contrat'] = $_POST['e_contrat'];

            $e_tempstravail = $_POST['e_tempstravail'];
            $e_contrat = $_POST['e_contrat'];
        }

        //Verifier si données est vide;
        if (empty($designation)) {
            $valid = false;
            $message = "<br> Le nom est obligatoire";
        }
        if (empty($localisation)) {
            $valid = false;
            $message = $message . "<br> Le lieu est obligatoire";
        }
        if (empty($description)) {
            $valid = false;
            $message = $message . "<br> La description du poste est obligatoire";
        }
        if (empty($missions)) {
            $valid = false;
            $message = $message . "<br> Les missions sont à décrire. ";
        }
        if (empty($profil)) {
            $valid = false;
            $message = $message . "<br> Le profil du poste est à décrire. ";
        }
        if ($type == 'S') {
            if (empty($duree)) {
                $valid = false;
                $message = $message . "<br> La durée du stage est obligatoire. ";
            }
        } else if ($type == 'E') {
            if (empty($e_tempstravail)) {
                $valid = false;
                $message = $message . "<br> Le temps de travail pour l'emploi est obligatoire. ";
            }
        }

        //Verifier les validité des données
        if ($valid == true) {
            $d['message'] = 'test';
            $lgdesignation = strlen($designation);
            if ($lgdesignation > 50) {
                $valid = false;
                $message = $message . "<br> Le nom est trop long. Veuillez réduire le nom.";
            }

            $lglocalisation = strlen($localisation);
            if ($lglocalisation > 100) {
                $valid = false;
                $message = $message . "<br> La localisation n'est pas valide, elle doit être inférieur à 100 caractères";
            }
            //Si c'est stage
            if ($type == 'S') {
                if (!ctype_digit($duree)) {
                    $valid = false;
                    $message = $message . "<br> La durée n'est pas correct, veuillez insérer un nombre.";
                }
                //Verifier date
                $position = strpos($datedebut, "-");
                if ($position === false) {
                    list($jour, $mois, $annee) = explode("/", $datedebut);
                } else {
                    list($annee, $mois, $jour) = explode("-", $datedebut);
                }
                if ($jour > 31 || $jour < 1) {
                    $valid = false;
                    $message = $message . "<br> Le jour doit être compris entre 1 et 31.";
                }
                if ($mois < 1 || $mois > 12) {
                    $valid = false;
                    $message = $message . "<br> Le mois doit être compris entre 1 et 12.";
                }
                if (strlen($annee) < 4 || strlen($annee) > 4) {
                    $valid = false;
                    $message = $message . "<br> L'année doit avoir au moins 4 chiffres.";
                }
                if ($valid == true) {
                    $datedebut = $annee . "-" . $mois . "-" . $jour;
                }
            } else if ($type == 'E') { //Si c'est emploi
                if (!ctype_digit($e_tempstravail)) {
                    $valid = false;
                    $message = $message . "<br> La durée n'est pas correct, veuillez insérer un nombre.";
                }
            }
        }
        //Si tout est ok on lance les requêtes
        if ($valid == true) {
            $cle = array();
            $cle['p_code'] = $p_code;

            $tab = array();
            $tab['cle'] = $cle;
            $tab['donnees'] = $donnees;

            //3 requêtes
            //Pour la table propositions
            $modPropositions->update($tab);
            //Si la proposition est un stage 
            if ($type == 'S') {
                //Pour la table stages 
                $tab2 = array();
                $tab2['cle'] = $cle;
                $tab2['donnees'] = $donnees2;
                $modStages->update($tab2);
            } else if ($type == 'E') {
                //Ou pour la table emplois
                $tab3 = array();
                $tab3['cle'] = $cle;
                $tab3['donnees'] = $donnees3;

                $modEmplois->update($tab3);
            }
            $messageok = "Proposition modifiée";
        }
        if ($valid == true) {
            //Pour réafficher les données
            $d['proposition'] = $modPropositions->findFirst(array('conditions' => array('p_code' => $p_code)));
            $d['proposition'] = $modPropEnt->findFirst(array('conditions' => array('p_code' => $p_code)));
        }
        $d['messageok'] = $messageok;
        $d['message'] = $message;
        $this->set($d);
        //on réaffiche la proposition
        $this->affichProp($id);
    }

    function listeProp() {
        $d['messageok'] = ""; //Message à vide
        //Charger le model
        $modPropEnts = $this->loadModel('PropEnt');

        //Requête SQL ~ Propositions acceptées
        $d['propositions'] = $modPropEnts->find(array('conditions' => array('p_acceptation' => 1)));
        $d['nbPropositions'] = (count($d['propositions'])); //Compter le nombre de propositions en liste
        $this->set($d);
    }

    function detailProp($id) {
        //récupère l'id dans l'url
        $d['e_code'] = $id[0];
        $p_code = $id[0];
        $d['message'] = ''; //Message à vide
        //Charger le model
        $modPropEnt = $this->loadModel('PropEnt');
        $modEmploi = $this->loadModel('Emploi');
        $modStage = $this->loadModel('Stage');

        //Requête SQL ~ Pour les détails de la proposition
        $d['proposition'] = $modPropEnt->findFirst(array('conditions' => array('p_code' => $p_code)));
        $d['emploi'] = $modEmploi->findFirst(array('conditions' => array('p_code' => $p_code)));
        $d['stage'] = $modStage->findFirst(array('conditions' => array('p_code' => $p_code)));
        $type = $d['proposition']->p_type; //Chercher si c'est un stage ou un emploi
        //Si c'est un stage
        if ($type == "S") {
            //On change la forme de la date
            $datedebut = $d['stage']->s_datedebut;
            list($annee, $mois, $jour) = explode("-", $datedebut);
            $datedebut = $jour . '/' . $mois . '/' . $annee;
        }
        $this->set($d);
    }

}
