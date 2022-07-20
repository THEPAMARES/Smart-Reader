<?php

class User extends Db
{

// Récupération de tous les utilisateurs (admin)------------------------------------
    public static function getAllUsers()
    {
    // Requête SQL pour l'affichage
        $request = "SELECT * FROM user ORDER BY id_user DESC";
    // Préparation de la requête avec connexion à la BDD
        $preparedRequest = self::getDb()->prepare($request);
    // Execution de la requête
        $preparedRequest->execute();
    // Retour des info de tous les utilisateurs sous forme de liste 
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);

    }

// Récupération des infos d'un seul utilisateur--------------------------------------
    public static function getInfoUser($data)
    {
    // Requête SQL pour l'affichage de l'utilisateur grâce à $id
        $request = "SELECT * FROM user WHERE id_user=:id_user";
    // Préparation
        $preparedRequest = self::getDb()->prepare($request);
    // Execution de la requête
        $preparedRequest->execute($data);
    // Retour des infos de l'utilisateur sous forme de liste
        return $preparedRequest->fetch(PDO::FETCH_ASSOC); 
    }


    /**Ajouter et modifier dans la base de données */
    public static function insertUser(array $data)
    {
        $request="REPLACE INTO user VALUES (:id_user,:name, :firstname, :pseudo, :pw, :email, :birthdate, :address, :inscription_date, :point,:photo, :admin, :disabled)";
        $response=self::getDb()->prepare($request);
        return $response->execute($data);
    }
/********************************** Vérifications **************************************/  

// Vérification si connecté
    public static function isConnected(){
        if(isset($_SESSION["pseudo"])){
            return true;
        }
        return false;
    }

// Vérification si champ existe ou pas vide
    public static function verifPresence($champ){

        // false si champ n'existe pas
        if(!isset($champ)){
            return false;
        }
        
        // false si champ est vide
        if(empty($champ)){
            return false;
        }
        return true;
    }

// Vérification pseudo
    public static function verifPseudo($pseudo){
        if(strlen($pseudo)<=3 OR strlen($pseudo)>255){
            return false;
        }
        return true;
    }

// Vérification mail
    public static function verifMail($mail){
        if(strlen($mail)<4 OR strlen($mail)>255){
            return false;
        }
        return true;

        //Vérif si le format est bien un email
        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }


//Verif si admin ou pas 
    public static function verifAdmin($admin){

        if ($admin ==0){
            return true;
        }
    }

/**Verif format photo */
public static function verifPhoto($photo){

    if($photo['type'] == "image/png"){
        return true;
    }

    if($photo['type'] == "image/jpeg"){
        return true;
    }

    if($photo['type'] == "image/jpg"){
        return true;
    }

    return false;
}

/******************************** Eclater chemin photo*********************************************/
    public static function explodePhoto($photoRoad){
        return explode("photo_profil/",$photoRoad);
    }

/***************************************** CONNEXION ********************************************* */

// récupération des infos de l'utilisateur pour vérifier correspondance entre pseudo et mdp pour la connexion
public static function connexionVerif($data)
{       

    // Récup info user grace au pseudo
    $resquest = "SELECT * FROM user WHERE pseudo=:pseudo";
    $preparedRequest = self::getDb()->prepare($resquest);
    $preparedRequest->execute($data);
    return $preparedRequest->fetch(PDO::FETCH_ASSOC);
    
}

//Récup user grâce à pseudo 
public static function pseudoExist($data){
    $resquest = "SELECT * FROM user WHERE pseudo=:pseudo";
    $preparedRequest = self::getDb()->prepare($resquest);
    $preparedRequest->execute($data);
    return $preparedRequest->fetch(PDO::FETCH_ASSOC);
}

//Récup user grâce à mail 
public static function mailExist($data){
    $resquest = "SELECT * FROM user WHERE email=:email";
    $preparedRequest = self::getDb()->prepare($resquest);
    $preparedRequest->execute($data);
    return $preparedRequest->fetch(PDO::FETCH_ASSOC);
}

// Création SESSION si connexionVerif Ok:
    public static function connexionValid($infoUser){
        
        $_SESSION["id_user"] = $infoUser["id_user"];
        $_SESSION["nom"] = $infoUser["name"];
        $_SESSION["prenom"] = $infoUser["firstname"];
        $_SESSION["pseudo"] = $infoUser["pseudo"];
        $_SESSION["pw"] = $infoUser["pw"];
        $_SESSION["email"] = $infoUser["email"];
        $_SESSION["birthdate"] = $infoUser["birthdate"];
        $_SESSION["address"] = $infoUser["address"];
        $_SESSION["inscription_date"] = $infoUser["inscription_date"];
        $_SESSION["point"] = $infoUser["point"];
        $_SESSION["photo"] = $infoUser["photo"];
        $_SESSION["admin"] = $infoUser["admin"];
        $_SESSION["disabled"] = $infoUser["disabled"];
        $_SESSION["readPhoto"] = self::explodePhoto($infoUser["photo"]);

    }

// Destruction SESSION pour déconnexion
    public static function destroySession($deconnexion){
        // Si SESSION existe et que "deconnexion" dans GET :
        if(isset($_SESSION["pseudo"]) && $deconnexion=="ok"){
            //Détruit la session
            session_destroy(); 
        }
    }


// Enregistrement de la photo, puis a l'enregistrement en bdd
    public static function savePhoto($pseudo,$photo){

        if (empty($msg)){
            // On ne procede a l'enregistrement que s'il n'y a pas de message d'erreurs


            $cheminTelechargement = PHOTO. 'photo_profil/' . $pseudo . "-" . time() . "-" . str_replace(' ', '-', $photo["name"]);
            return $cheminTelechargement;

        }
    
    }

// Desactivation de compte
    public static function disabledSession($disabled){
        $requete = ("UPDATE user SET disabled=:disabled WHERE id_user=:id_user");
        $requetePrepare = self::getDb()->prepare($requete);
        $requetePrepare->execute($disabled);
    }
    
// Selection de tous les users en disabled
    public static function getAllDisabled($data)
    {
    // Requête SQL pour selectionner tous les users disabled
        $request = "SELECT * FROM user WHERE disabled=:disabled";
    // Préparation de la requête avec connexion à la BDD
        $preparedRequest = self::getDb()->prepare($request);
    // Execution de la requête
        $preparedRequest->execute($data);
    // Retour des infos de tous les utilisateurs sous forme de liste 
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }


}
//Ne plus rien mettre












?>