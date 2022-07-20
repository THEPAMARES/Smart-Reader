<?php

class UserController
{

/************************************* monCompte *********************************************************************/
    public static function compteDetail()
    {
    // Si pas de compte ou désactivé, redirige sur page connexion
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }
    
    // Récupération des info d'un seul user
        $infoUser = User::getInfoUser([
            'id_user'=>$_SESSION['id_user']
        ]);


    // DESACTIVATION compte----------------------------------
        if(User::verifPresence($_GET) && $_GET['supprimer'] == "ok"){
            User::disabledSession([
                'disabled'=>1,
                'id_user'=>$_SESSION['id_user']
            ]);

            //Destruction SESSION
            User::destroySession($_GET['supprimer']);

            // Redirection accueil
            header("location:".BASE_PATH);
            exit;
        }
        include VIEWS . "user/detail.php";
    }


/*******************************************INSCRIPTION ***********************************************/    
    public static function replaceUser()
    {
        // Vérifier la connexion de l'utilisateur, si ok redirection vers modifCompte

        if(User::isConnected()){
            header("location:".BASE_PATH."monCompte");
            exit;
        }

        $msg = '';

        if (!empty($_POST)){
            $pseudo= $_POST['pseudo'];

            //Pour vérif si pseudo exist déjà dans BDD
            $pseudoExist = User::pseudoExist(['pseudo'=>$pseudo]);
            //Pour vérif si mail exist déjà dans BDD
            $mailExist = User::mailExist(['email'=>$_POST['email']]);

            //Vérif champs--------------------------------------------------
            if(!User::verifPresence($_POST["name"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre nom.
                </div>"; 
            }

            if(!User::verifPresence($_POST["firstname"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre prénom.
                </div>"; 
            }

            if(!empty($pseudoExist)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Le pseudo existe déjà.
                </div>"; 
            }

            if(!User::verifPresence($pseudo) || !User::verifPseudo($pseudo)){
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Le pseudo soit être compris entre 4 et 50 caractères.
                    </div>"; 
            }
    
            if(!User::verifPresence($_POST["pw"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir un mot de passe.
                </div>"; 
            }

            if(!empty($mailExist)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                L'adresse mail existe déjà.
                </div>"; 
            }

            if(!User::verifPresence($_POST["email"]) || !User::verifMail($_POST["email"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                L'adresse email n'est pas valide.
                </div>";
            }

            if(!User::verifPresence($_POST["birthdate"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre date de naissance.
                </div>"; 
            }

            if(!User::verifPresence($_POST["address"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre adresse.
                </div>"; 
            }

        }
        
        //Vérifications photo
        if (!empty($_FILES)){
            $photo = $_FILES['photo'];
            $size = $_FILES['photo']["size"];

            // Controle du format de la photo
            if (!User::verifPhoto($photo)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Votre photo n'est pas valide. Seul les jpg, jpeg et png sont acceptés. 
                </div>";
            }

            if($size >= 100000){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    La photo ne doit pas dépasser 100ko.
                </div>";

            }

            //Vérif chemin photo
            $cheminDb=User::savePhoto($pseudo, $photo);

            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $cheminDb)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement de votre fichier
                </div>";

        
            }

        /// insert 
            if (empty($msg)){

                $resultat = User::insertUser([
                    'id_user' => NULL,
                    'name' => $_POST['name'],
                    'firstname' => $_POST['firstname'],
                    'pseudo' => $_POST['pseudo'],
                    'pw' => password_hash($_POST["pw"],PASSWORD_DEFAULT),
                    'email' => $_POST['email'],
                    'birthdate' => $_POST['birthdate'],
                    'address' => $_POST['address'],
                    'inscription_date' => null,
                    'point' => 0,
                    'photo' => $cheminDb,
                    'admin' => 0,
                    'disabled' => 0,
                    

                ]);
                if ($resultat){
                    setcookie("success", "Inscription réussie!", time()+5);
                    header("location:".BASE_PATH. "connexion");
                    exit;
                }else{
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement en base de donnée
                    </div>";
                }
            }
        }
                include VIEWS . 'user/inscription.php';
    }

/******************************************* MODIFICATION ***********************************************/    
public static function updateUser()
{
    // Vérifier la connexion de l'utilisateur, si ok redirection vers modifCompte

    if(!User::isConnected()){
        header("location:".BASE_PATH."connexion");
        exit;
    }

    // echo '<pre>';
    // print_r($_FILES);
    // print_r($_POST);
    // print_r($_SESSION);
    // echo '</pre>';

    $msg = '';

    /// modif
    if (!empty($_POST)){
        $pseudo= $_POST['pseudo'];
    
        //Pour vérif si pseudo exist déjà dans BDD
        $pseudoExist = User::pseudoExist(['pseudo'=>$_POST['pseudo']]);
        //Pour vérif si mail exist déjà dans BDD
        $mailExist = User::mailExist(['email'=>$_POST['email']]);

        
        //Vérif champs -------------------------------------------
        if (!empty($_POST)){
            if(!User::verifPresence($_POST["name"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre nom.
                </div>"; 
            }

            if(!User::verifPresence($_POST["firstname"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre prénom.
                </div>"; 
            }

            if($_POST['pseudo']!=$_SESSION['pseudo'] && !empty($pseudoExist)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Le pseudo existe déjà.
                </div>"; 
            }

            if(!User::verifPresence($pseudo) || !User::verifPseudo($pseudo)){
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Le pseudo soit être compris entre 4 et 50 caractères.
                    </div>"; 
            }

            if($_POST['email']!=$_SESSION['email'] && !empty($mailExist)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                L'adresse mail existe déjà.
                </div>"; 
            }

            if(!User::verifPresence($_POST["email"]) || !User::verifMail($_POST["email"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                L'adresse email n'est pas valide.
                </div>";
            }

            if(!User::verifPresence($_POST["birthdate"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre date de naissance.
                </div>"; 
            }

            if(!User::verifPresence($_POST["address"])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Veuillez saisir votre adresse.
                </div>"; 
            }



        }
        
        //Vérif photo---------------------------------------------------
        if (empty($_FILES['photo']["tmp_name"])){
            $cheminModifPhoto = $_SESSION["readPhoto"][0]."photo_profil/".$_SESSION['readPhoto'][1];
        }else{
            $cheminModifPhoto = User::savePhoto($pseudo, $_FILES['photo']);

            $size = $_FILES["photo"]["size"];

            // Controle du format de la photo
            if (!User::verifPhoto($_FILES['photo'])){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Votre photo n'est pas valide. Seul les jpg, jpeg et png sont acceptés. La taille ne doit pas dépasser 100ko.
                </div>";
            }

            if($size >= 100000){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                     La photo ne doit pas dépasser 100ko.
                </div>";

            }

            if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $cheminModifPhoto)){
            $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement de votre fichier
            </div>";
            }
        }
        
        //Si tout va bien, modifie :  
        if (empty($msg)){
    
            $resultat = User::insertUser([
                'id_user' => $_SESSION["id_user"],
                'name' => $_POST['name'],
                'firstname' => $_POST['firstname'],
                'pseudo' => $_POST['pseudo'],
                'pw' => $_SESSION["pw"],
                'email' => $_POST['email'],
                'birthdate' => $_POST['birthdate'],
                'address' => $_POST['address'],
                'inscription_date' => null,
                'point' => $_SESSION["point"],
                'photo' => $cheminModifPhoto,
                'admin' => $_SESSION["admin"],
                'disabled' => "0",
                

            ]);
    
            $_SESSION['nom'] = $_POST['name'];
            $_SESSION['prenom'] = $_POST['firstname'];
            $_SESSION['pseudo'] = $_POST['pseudo'];
            // $_SESSION['pw'] = password_hash($_POST["pw"],PASSWORD_DEFAULT);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['birthdate'] = $_POST['birthdate'];
            $_SESSION['address'] = $_POST['address'];
            $_SESSION['photo'] = $cheminModifPhoto;
            $_SESSION["readPhoto"] = User::explodePhoto($cheminModifPhoto);

            if ($resultat){
                header("location:".BASE_PATH. "monCompte");
                exit;
            }else{
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement en base de donnée
                </div>";
            }
        }
        
    }
    include VIEWS . 'user/modifCompte.php';
}

/*******************************************CONNEXION *********************************************************/
    public static function connexion()
    {
    // Vérifier la connexion de l'utilisateur--------
        // Si compte existe, redirection page monCompte
        if(User::isConnected()){
            header("location:".BASE_PATH."monCompte");
            exit;
        }

        $disabledList = User::getAllDisabled([
            'disabled'=>1
        ]);

        // Si POST n'est pas vide, stocke les données POST dans des variables :
        if(!empty($_POST)){
            $pseudo=$_POST["pseudo"];
            $mdp=$_POST["mdp"];
            $msg="";

            //Contrôle si compte désactivé
            foreach($disabledList as $cle=>$disabled){
                if($_POST['pseudo']==$disabledList[$cle]['pseudo']){
                    setcookie("disabledAccount", "Le compte n'est plus actif, veuillez contacter le service client pour le réactiver ou bien créer un nouveau compte.", time()+5);

                    header("location:".BASE_PATH."connexion");
                    exit;    
                }
            }

            if(!User::verifPresence($pseudo)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">Veuillez saisir votre pseudo</div>";
            }
        
            if(!User::verifPresence($mdp)){
                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">Veuillez saisir votre mot de passe</div>";
            }
    
            if(empty($msg)){

                // Applique la méthode de vérification de la connexion :
                $infoUser = User::connexionVerif([
                    'pseudo'=>$pseudo=$_POST["pseudo"]
                ]);
                
                // Si pseudo n'est pas dans la BDD ou si mdp ne correspond pas :
                if($infoUser == ""){
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">Le pseudo ou le mot de passe est incorrect. Veuillez réesayer.</div>";
                }elseif(!password_verify($mdp, $infoUser["pw"])){
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">Le pseudo ou le mot de passe est incorrect. Veuillez réessayer.</div>";
                }else{
                    User::connexionValid($infoUser);
                    setcookie("success", "Bienvenue ".$_POST['pseudo']." ! Nous te souhaitons une très bonne visite!", time()+5);
                    header("location:".BASE_PATH);
                    exit;
            
                }
            }

        }

        include VIEWS . "user/connexion.php";
    }

    
    public static function deconnexion($deconnexion){
        
        if(!User::isConnected()){
            header("location:".BASE_PATH);
            exit;
        }

        if($deconnexion == "ok"){
            User::destroySession($deconnexion);
            setcookie("disconnect", "Merci de ta visite et à la prochaine!", time()+5);

            // Redirection accueil
            header("location:".BASE_PATH);
            exit;
        }

    }


}
    





?>