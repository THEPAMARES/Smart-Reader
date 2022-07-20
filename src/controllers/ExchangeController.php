<?php

class ExchangeController 
{
// Afficher toutes les offres --------------------------------
    public static function allOffersList(){
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $msg1 = "";

        //Afficher points utilisateur:
        $infoUser = User::getInfoUser([
            'id_user'=>$_SESSION['id_user']
        ]);

        $point = $infoUser['point'];

        $listAllOffres = Exchange::allAvailableDeals([
            'dealing_position'=>'offer',
            'done'=>'0'
        ]);

        if(empty($listAllOffres)){
            $msg1 = "Aucune offre disponible";
        }

        foreach($listAllOffres as $cle=>$offre){
            $listAllOffres[$cle]['etat']=Deal::pointToCondition($offre['point_offers']);

            $listAllOffres[$cle]['api'] = Book::oneBook($listAllOffres[$cle]["id_book"]);

        //Recup info user avec id
            $listAllOffres[$cle]['user'] = Exchange::getUserInfo([
                'id_user' => $listAllOffres[$cle]['id_user']
            ]);

        }


        include VIEWS . "exchange/readAllOffers.php";
    }

    // Afficher toutes les demandes --------------------------------
    public static function allWishesList(){
        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $msg1 = "";

        //Afficher points utilisateur:
        $infoUser = User::getInfoUser([
            'id_user'=>$_SESSION['id_user']
        ]);

        $point = $infoUser['point'];
        
        
        $listAllWishes = Exchange::allAvailableDeals([
            'dealing_position'=>'request',
            'done'=>'0'
        ]);

        if(empty($listAllWishes)){
            $msg1 = "Aucune demande disponible";
        }

        foreach($listAllWishes as $cle=>$wish){
            $listAllWishes[$cle]['etat']=Deal::pointToCondition($wish['point_offers']);

            $listAllWishes[$cle]['api'] = Book::oneBook($listAllWishes[$cle]["id_book"]);

        //Recup info user avec id
            $listAllWishes[$cle]['user'] = Exchange::getUserInfo([
                'id_user' => $listAllWishes[$cle]['id_user']
            ]);

        }
    
    
        include VIEWS . "exchange/readAllWishes.php";
    }



//---------------------------------------------------------------
    // Afficher les détails de l'échange, avec nom du pseudo et bouton pour accepter l'échange (delete l'offre au moment de l'acceptation dans dealing, ajout ligne dans exchange, calcul des points)
    public static function tradeDetail(){

        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        $msg="";
        $msgDisable="";

        //Récupération données dealing pour pseudo et dynamisme page--------------------------------
        $infoDeal = Deal::readOneDeal([
            'id_deal'=>$_GET['idDeal']
        ]);


        //Définition du $title en fonction du deal
        if($infoDeal[0]["dealing_position"]=="offer"){
            $title = "l'offre";
            $userPosition = "Détenu par ";
            $chemin = "allOffres";
        }else{
            $title = "la demande";
            $userPosition = "Demandé par ";
            $chemin = "allSouhaits";
        }

        //Récupération données de celui qui fait la proposition grace à infoDeal
        $proposer = Exchange::getUserInfo([
            "id_user"=>$infoDeal[0]['id_user']
        ]);

        //Récupération données de celui qui va accepter la proposition grace à Session  
        $actor = Exchange::getUserInfo([
            "id_user"=>$_SESSION['id_user']    
        ]);

        //Récupération données livre API
        $livreInfo = Book::oneBook($_GET['idLivre']);
        $detailLivre = $livreInfo["volumeInfo"];

        // Récupération état livre
        $etat = Deal::pointToCondition($infoDeal[0]['point_offers']);

        // CONTROLES---------------------------------------------------------
        //Si done =1, le livre a déjà été échangé (au cas où quelqu'un tombe sur la page par accident)
        if(Deal::done($infoDeal[0]["done"])){
            $msgDisable ="Désolée, ce livre a déjà été échangé.<br>";
        }

        //Si acheteur pas assez de point, pour une offre :
        if(Deal::isOffer($infoDeal[0]["dealing_position"])
            && !Exchange::pointControl($actor[0]['point'],$infoDeal[0]["point_offers"])
        ){
            $msgDisable = "<div class=\"alert alert-warning w-75 mx-auto text-center my-3\" role=\"alert\">Vous n'avez pas assez de point pour effectuer cet échange.</div>";
        }
        //Si acheteur pas assez de point, pour une demande :
        if(!Deal::isOffer($infoDeal[0]["dealing_position"])
            && !Exchange::pointControl($proposer[0]['point'],$infoDeal[0]["point_offers"])
        ){
            $msgDisable = $proposer[0]['pseudo']." n'a pas assez de point pour effectuer cet échange.";
        }

        // Ne peut pas échanger avec soi-même
        if(Exchange::sameUser($infoDeal[0]['id_user'])){
            $msgDisable ="Attention! Vous ne pouvez pas échanger avec vous-même.<br>";
        }

        // Si tout est OK -----------------------------------------------: 
        if(!Deal::done($infoDeal[0]["done"])
            &&isset($_GET['echange']) && $_GET['echange']=='ok'
            &&!Exchange::sameUser($infoDeal[0]['id_user'])
            &&Exchange::getControl($_GET['idDeal'])
            &&Exchange::getControl($_GET['idLivre']))
        {

            //quand on accepte une offre, insert BDD
            if(Deal::isOffer($infoDeal[0]["dealing_position"])){
                //Insertion données échange dans exchange
                Exchange::insertExchange([
                    'id_exchange'=>NULL,
                    'id_deal'=>$infoDeal[0]['id_deal'],
                    'id_purchaser'=>$_SESSION['id_user'],
                    'id_book'=> $_GET['idLivre'],
                    'id_owner'=>$infoDeal[0]["id_user"],
                    'dealing_point'=>$infoDeal[0]["point_offers"],
                    'purchase_date'=>NULL,
                ]);

                //Gestion points------------
                if(Exchange::pointControl($actor[0]['point'],$infoDeal[0]["point_offers"])){
                    //Retrait point pour purchaser------------
                    Exchange::updatePoint([
                        'point'=>$actor[0]['point']-$infoDeal[0]["point_offers"],
                        'id_user'=>$_SESSION['id_user']
                    ]);

                    //Ajout points pour owner----------------
                    Exchange::updatePoint([
                        'point'=>$proposer[0]['point']+$infoDeal[0]["point_offers"],
                        'id_user'=>$proposer[0]['id_user']
                    ]);
                }

            }

            //Si on accepte une demande
            if(!Deal::isOffer($infoDeal[0]["dealing_position"])){
                //Insertion données échange dans exchange
                Exchange::insertExchange([
                    'id_exchange'=>NULL,
                    'id_deal'=>$infoDeal[0]['id_deal'],
                    'id_purchaser'=>$infoDeal[0]["id_user"],
                    'id_book'=> $_GET['idLivre'],
                    'id_owner'=>$_SESSION['id_user'],
                    'dealing_point'=>$infoDeal[0]["point_offers"],
                    'purchase_date'=>NULL,
                ]);

                //Gestion points------------
                if(Exchange::pointControl($proposer[0]['point'],$infoDeal[0]["point_offers"])){
                    //Retrait point pour purchaser
                    Exchange::updatePoint([
                        'point'=>$proposer[0]['point']-$infoDeal[0]["point_offers"],
                        'id_user'=>$proposer[0]['id_user']
                    ]);
                    
                    //Ajout points pour owner----------------
                    Exchange::updatePoint([
                    'point'=>$actor[0]['point']+$infoDeal[0]["point_offers"],
                        'id_user'=>$_SESSION['id_user']
                    ]);

                }
            }
                
            // Mise à jour dealing done=1 
            Deal::dealDone([
                'done'=>'1',
                'id_deal'=>$infoDeal[0]['id_deal']
            ]);

            
            header("location:" . BASE_PATH . $chemin);
            exit;
            
        }

        include VIEWS . "exchange/exchangePlace.php";
    }

    //-------------------------------------------------------------------
    //Affichage de tous les échanges conclus pour l'admin, du plus récent au plus ancien
    public static function allTrades(){

        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }

        if(!AdminController::isAdmin()){
            header("location:".BASE_PATH);
            exit;
        }
        
        
        $echangeListe=Exchange::allExchanges();

        foreach($echangeListe as $cle=>$echange){
            $echangeListe[$cle]['api'] = Book::oneBook($echangeListe[$cle]["id_book"]);

            $echangeListe[$cle]['purchaser'] = Exchange::getUserInfo([
                'id_user' => $echangeListe[$cle]['id_purchaser']
            ]);

            $echangeListe[$cle]['owner'] = Exchange::getUserInfo([
                'id_user' => $echangeListe[$cle]['id_owner']
            ]);


        }


        include VIEWS . "exchange/allHistorique.php";
    }

    //-------------------------------------------------------------------
    //Affichage de tous les échanges conclus par un utilisateur, du plus récent au plus ancien

    public static function myTradesList(){

        if(!User::isConnected()){
            header("location:".BASE_PATH."connexion");
            exit;
        }
        //Echanges pour lesquels l'user était acquiéreur
        $acquisitionList=Exchange::allIGet([
            'id_purchaser'=>$_SESSION['id_user']
        ]);

        //Echanges pour lesquels l'user était vendeur
        $cessionList=Exchange::allIGive([
            'id_owner'=>$_SESSION['id_user']
        ]);

        //récup liste info de l'autre utilisateur
        foreach($acquisitionList as $cle=>$acquisition){
            $acquisitionList[$cle]['api'] = Book::oneBook($acquisitionList[$cle]["id_book"]);

            $acquisitionList[$cle]['owner'] = Exchange::getUserInfo([
                'id_user' => $acquisitionList[$cle]['id_owner']
            ]);

        }

        foreach($cessionList as $cle=>$cession){
            $cessionList[$cle]['api'] = Book::oneBook($cessionList[$cle]["id_book"]);

            $cessionList[$cle]['purchaser'] = Exchange::getUserInfo([
                'id_user' => $cessionList[$cle]['id_purchaser']
            ]);

        }

        include VIEWS . "exchange/historique.php";
    }


  















}


?>