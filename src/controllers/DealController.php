<?php

class DealController
{

    // Ajouter une offre------------------------------------------------------------
    public static function addOffer(){
        //Si pas connecté, renvoie à la page connexion
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        //Si pas de GET, renvoie à la liste d'offres
        if(empty($_GET)){
            header("location:".BASE_PATH."mesOffres");
            exit;
        }

        //SI GET n'est pas vide
        if(!empty($_GET)){

            //Crée la variable qui stocke les infos d'un seul livre
            $livreInfo = Book::oneBook($_GET['id']);
            $detailLivre = $livreInfo["volumeInfo"];

            //Si POST n'est pas vide
            if(!empty($_POST)){
                $msg="";
                // Attribue des points en fonction de l'état du livre
                if($_POST['etat']==""){
                    $msg.="<div class=\"alert alert-danger\" role=\"alert\">
                    Veuillez renseigner l'état du livre.
                    </div>";
                }

                if($_POST["etat"]!=""){
                    if($_POST['etat']=="mauvais"){
                        $point = 1;
                    }
                    
                    if($_POST['etat']=="bon"){
                        $point = 2;
                    }
                    
                    if($_POST['etat']=="neuf"){
                        $point = 3;
                    }
                                
                    if($_POST['etat']=="rare"){
                        $point = 4;
                    }

                    Deal::addDeal([
                        'id_deal' =>null,
                        'id_user' => $_SESSION["id_user"],
                        'id_book' => $_GET["id"],
                        'dealing_position' => "offer",
                        'point_offers' => $point,
                        'done' =>'0',
                        'dealing_date' =>null
                    ]);

                    //Création cookie
                    setcookie("stockTitreLivre", $detailLivre['title'], time()+5);

                    header ("location:".BASE_PATH."mesOffres");
                    exit;
                }
            }
        }
        include VIEWS . "deal/addOffre.php";
    }

    // Ajouter un souhait ------------------------------------------------------------

    public static function addWish(){
        //Si pas connecté, renvoie à la page connexion
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        //Si pas de GET, renvoie à la liste de demandes
        if(empty($_GET)){
            header("location:".BASE_PATH."mesSouhaits");
            exit;
        }

        //SI GET n'est pas vide
        if(!empty($_GET)){

            //Crée la variable qui stocke les infos d'un seul livre
            $livreInfo = Book::oneBook($_GET['id']);
            $detailLivre = $livreInfo["volumeInfo"];

            //Si POST n'est pas vide
            if(!empty($_POST)){
                $msg="";
                // Attribue des points en fonction de l'état du livre
                if($_POST['etat']==""){
                    $msg.="<div class=\"alert alert-danger\" role=\"alert\">
                    Veuillez renseigner l'état du livre.
                    </div>";
        
                }

                if($_POST["etat"]!=""){
                    if($_POST['etat']=="mauvais"){
                        $point = 1;
                    }
                    
                    if($_POST['etat']=="bon"){
                        $point = 2;
                    }
                    
                    if($_POST['etat']=="neuf"){
                        $point = 3;
                    }
                                
                    if($_POST['etat']=="rare"){
                        $point = 4;
                    }

                    Deal::addDeal([
                        'id_deal' =>null,
                        'id_user' => $_SESSION["id_user"],
                        'id_book' => $_GET["id"],
                        'dealing_position' => "request",
                        'point_offers' => $point,
                        'done' =>'0',
                        'dealing_date' =>null
                    ]);

                    setcookie("stockTitreLivre", $detailLivre['title'], time()+5);

                    header ("location:".BASE_PATH."mesSouhaits");
                    exit;

                }
            }
        }
        include VIEWS . "deal/addWish.php";
    }

    // Afficher la liste des offres de tous les utilisateurs------------------------------------------------------------
    public static function allOffersList(){
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $listeAllOffres = Deal::readAllDeals([
            'dealing_position'=>'offer',
        ]);

        include VIEWS . "deal/readAllOffers.php";

    }

    // Afficher la liste des demandes de tous les utilisateurs------------------------------------------------------------
    public static function allWishList(){
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $listeAllOffres = Deal::readAllDeals([
            'dealing_position'=>'request',
        ]);

        include VIEWS . "deal/readAllWishes.php";

    }
    
    // Afficher la liste des offres d'un user------------------------------------------------------------
    public static function offersList(){
        // Si pas de compte, redirige sur page connexion
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $msg1="";

        // Création d'une liste qui va regrouper toutes lignes de la table dealing
        $listeOffres = Deal::readDeal([
            'dealing_position'=>'offer',
            'id_user'=>$_SESSION['id_user']
        ]);

        // Message si pas d'offres
        if(empty($listeOffres)){
            $msg1="Vous n'avez pas d'offre";
        }
        
        // Création d'un nouvel index 'etat' dans la listeOffres et récupération des infos du livre grâce à l'id enregistré en BDD
        foreach($listeOffres as $cle=>$offre){
            // De base, listeDemandes affiche une liste des données récup dans la base de données dans une liste.
                // Ici, on va lui ajouter un index "etat" qui ne vient pas de la bdd
            $listeOffres[$cle]['etat']=Deal::pointToCondition($offre['point_offers']);

            // Récupération des info du livre grâce à l'id dans dealing
            $listeOffres[$cle]['api'] = Book::oneBook($listeOffres[$cle]["id_book"]);
        }

     
        

        // Supression de la ligne grâce au GET
        if(isset($_GET['deleteDeal']) && $_GET['deleteDeal'] == "ok"){
            Deal::deleteDeal([
                'id_deal'=>$_GET['id']
            ]);

            //Création cookie
            setcookie("modifDeal", "Le livre a bien été supprimé de la liste", time()+5);

            // Redirection accueil
            header("location:".BASE_PATH."mesOffres");
            exit;
        }
                

        include VIEWS . "deal/readOffers.php";

    }

    // Afficher la liste des demandes d'un user------------------------------------------------------------
    public static function wishList(){
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }
        
        $msg1="";

        $listeDemandes = Deal::readDeal([
            'dealing_position'=>'request',
            'id_user'=>$_SESSION['id_user']
        ]);

        // Message si pas d'offres
        if(empty($listeDemandes)){
            $msg1="Vous n'avez pas de demande pour l'instant.";
        }
        
        foreach($listeDemandes as $cle=>$demande){
            $listeDemandes[$cle]['etat']=Deal::pointToCondition($demande['point_offers']);

            $listeDemandes[$cle]['api'] = Book::oneBook($listeDemandes[$cle]["id_book"]);

        }

        if(isset($_GET['deleteDeal']) && $_GET['deleteDeal'] == "ok"){
            Deal::deleteDeal([
                'id_deal'=>$_GET['id']
            ]);

            //Création cookie
            setcookie("modifDeal", "Le livre a bien été supprimé de la liste", time()+5);

            header("location:".BASE_PATH."mesSouhaits");
            exit;
        }

        include VIEWS . "deal/readWishes.php";
    }

    // Modifier les points d'un deal------------------------------------------------------------------------------------------
        public static function modifDeal(){
            
            if(!User::isConnected()){
                header("location:".BASE_PATH."connexion");
                exit;
            }
            
            //Si pas de GET, renvoie à monCompte
            if(!isset($_GET['deal']) || empty($_GET['deal'])){
                header("location:".BASE_PATH."monCompte");
                exit;
            }
            
            //récup infoDeal
            $oneDealArray = Deal::readOneDeal([
                'id_deal'=>$_GET['deal']
            ]);   

            // Création variables pour le titre de la page et redirections
            if($oneDealArray[0]=="offer"){
                $title = "mon offre";
                $cancelModifRoad = "mesOffres";
            }else{
                $title = "ma demande";
                $cancelModifRoad = "mesSouhaits";
            }

            // Récupération des données du livre
            $livreInfo = Book::oneBook($oneDealArray[0]["id_book"]);
            $detailLivre = $livreInfo["volumeInfo"]; 
            
            // Récupération de $etat pour le menu select.
            $point = $oneDealArray[0]["point_offers"];

            // Conversion point en état pour affichage
            $etat = Deal::pointToCondition($point);

            //Si POST n'est pas vide
            if(!empty($_POST)){
                //Convertion état livre à point
                $newPoint = Deal::conditionToPoint($_POST['etat']);

                //Modification du nombre de point dans la BDD
                Deal::updateDeal([
                    'point_offers'=>$newPoint,
                    'id_deal'=>$oneDealArray[0]["id_deal"]
                ]);

                //Création cookie
                setcookie("modifDeal", "L'état du livre - ".$detailLivre["title"]." - a bien été modifié", time()+5);

                header("location:".BASE_PATH.$cancelModifRoad);
                exit;
            }


                
            include VIEWS . "deal/modifDeal.php";


        }


}

?>