<?php

class Exchange extends Db
{

/*******************READ************************************/

    // Requête imbriquée pour récupérer les infos des users
    public static function getUserInfo($data){
        $request = 
            "SELECT * FROM user WHERE id_user IN(
                SELECT id_user FROM dealing WHERE id_user=:id_user
            )";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher tous les échanges (admin)
    public static function allExchanges(){
        $request = "SELECT * FROM exchange ORDER BY id_exchange DESC";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute();
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher toutes les acquisitions d'un utilisateur
    public static function allIGet($data){
        $request = "SELECT * FROM exchange WHERE id_purchaser=:id_purchaser ORDER BY id_exchange DESC";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Afficher toutes les ventes d'un utilisateur
    public static function allIGive($data){
        $request = "SELECT * FROM exchange WHERE id_owner=:id_owner ORDER BY id_exchange DESC";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Affichage liste de toutes les offres ou de toutes les demandes (listes) de tous les utilisateurs EN COURS -------------------------------------------------------------------
    public static function allAvailableDeals($data){
        $request = "SELECT * FROM dealing WHERE dealing_position = :dealing_position AND done = :done";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
}



/*******************INSERT************************************/

    // Ajout ligne table exchange grâce à id
    public static function insertExchange($data){
        $request = "INSERT INTO exchange (id_exchange,id_deal, id_purchaser,id_book, id_owner, dealing_point, purchase_date) VALUES (:id_exchange,:id_deal, :id_purchaser, :id_book, :id_owner, :dealing_point, :purchase_date)";
        $preparedRequest=self::getDb()->prepare($request);
        $preparedRequest->execute($data);
    }

/*******************INSERT************************************/
    //Mise à jour des points chez les utilisateurs
    public static function updatePoint($data){
        $request = "UPDATE user SET point = :point WHERE id_user=:id_user";
        $preparedRequest = self::getDb()->prepare($request);
        return $preparedRequest->execute($data);

    }

/**********************CONTROLES********************************/
    //Controle get général
    public static function getControl($get){
        if(isset($get) && !empty($get)){
            return true;
        }
    }

    //Controle points 
    public static function pointControl($purchaserPoint,$pointOffers){
        if($purchaserPoint>=$pointOffers){
            return true;
        }

    }

    //Controle même utilisateur
    public static function sameUser($idUser){
        if($_SESSION['id_user']==$idUser){
            return true;
        }
        return false;
    }




}


?>