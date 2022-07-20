<?php

class Deal extends Db
{
//Ajouter, à la table deal, un livre (add)----------------------------------------------------------
    public static function addDeal($data){

        $resquest = "INSERT INTO dealing (id_deal,id_user, id_book, dealing_position, point_offers, done, dealing_date) VALUES (:id_deal,:id_user,:id_book,:dealing_position,:point_offers,:done,:dealing_date)";
        $preparedRequest = self::getDb()->prepare($resquest);
        return $preparedRequest->execute($data);
        
    }

//Modifier le nombre de points pour les deals (modifier)----------------------------------------------------------
    public static function updateDeal($data){
        $request = "UPDATE dealing SET point_offers = :point_offers WHERE id_deal=:id_deal";
        $preparedRequest = self::getDb()->prepare($request);
        return $preparedRequest->execute($data);
    }
    
//Modifier statut du deal en done---------------------------------------------
    public static function dealDone($data){
        $request = 'UPDATE dealing SET done = :done WHERE id_deal=:id_deal';
        $preparedRequest = self::getDb()->prepare($request);
        return $preparedRequest->execute($data);
    }

// Affichage liste de toutes les offres ou de toutes les demandes (listes) de tous les utilisateurs-------------------------------------------------------------------
public static function readAllDeals($data){
    $request = "SELECT * FROM dealing WHERE dealing_position = :dealing_position";
    $preparedRequest = self::getDb()->prepare($request);
    $preparedRequest->execute($data);
    return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
}


// Affichage liste offres ou demandes (listes) d'un utilisateur en particulier-------------------------------------------------------------------
    public static function readDeal($data){
        $request = "SELECT * FROM dealing WHERE dealing_position = :dealing_position AND id_user=:id_user";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }

        
// Affichage d'un deal en particulier -------------------------------------------------------------------
    public static function readOneDeal($data){
        $request = "SELECT * FROM dealing WHERE id_deal = :id_deal";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }   


// Conversion points <=> état (me suis compliquée la vie ici, changer si ya le temps avec BDD)---------------------------------------------------------------------------
    public static function pointToCondition($point){
        if($point==1){
            return "mauvais";
        }
        if($point==2){
            return "bon";
        }
        if($point==3){
            return "neuf";            
        }
        if($point==4){
            return "rare";
            
        }

    }

// Connversion état <=> point état (me suis compliquée la vie ici, changer si ya le temps avec BDD)---------------------------------------------------------------------------
public static function conditionToPoint($etat){
    if($etat=="mauvais"){
        return 1;
    }
    if($etat=="bon"){
        return 2;
    }
    if($etat=="neuf"){
        return 3;            
    }
    if($etat=="rare"){
        return 4;
        
    }

}

// DELETE deal ------------------------------------------------------------------------------
public static function deleteDeal($data){
    $request = "DELETE FROM dealing WHERE id_deal = :id_deal";
    $preparedRequest = self::getDb()->prepare($request);
    $preparedRequest->execute($data);

}

// Contrôles---------------------------------------------------------------------------------
public static function getControl($get){
    if(!isset($get)){
        return true;
    }
    if(empty($get)){
        return true;
    }
}

//échange fait
public static function done($done){
    if($done=='1'){
        return true;
    }
}

// Offre ou demande?
public static function isOffer($deal){
    if($deal=='offer'){
        return true;
    }

}

    
}
// Ne rien mettre après




?>