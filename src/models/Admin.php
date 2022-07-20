<?php

class Admin extends Db
{

    // Fonction pour afficher tous les users 
    public static function allUsers()
    {
        $req = ('SELECT * FROM user');
        $requetePrepare = self::getDb()->prepare($req);
        $requetePrepare->execute();

        $afficher = $requetePrepare->fetchAll(PDO::FETCH_ASSOC);

        return $afficher;

    }


    // DELETE user ------------------------------------------------------------------------------
    public static function deleteUser($data){
        $request = "DELETE FROM user WHERE id_user = :id_user";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);

    }

    // ADMIN user ------------------------------------------------------------------------------
    public static function adminUser($data){
        $request = "UPDATE user SET admin=:admin  WHERE id_user = :id_user";
        $preparedRequest = self::getDb()->prepare($request);
        $preparedRequest->execute($data);
    
    }
    
    // DISABLE user ------------------------------------------------------------------------------
    public static function disabledSession($disabled){
        $requete = ("UPDATE user SET disabled=:disabled WHERE id_user=:id_user");
        $requetePrepare = self::getDb()->prepare($requete);
        $requetePrepare->execute($disabled);
}
    /********************************************** ADMIN ***************************************************** */


    
// Selection de tous les users admin
    public static function getAdmin($admin)
    {
    // Requête SQL pour selectionner tous les users admin
        $request = "SELECT * FROM user WHERE admin=:admin";
    // Préparation de la requête avec connexion à la BDD
        $preparedRequest = self::getDb()->prepare($request);
    // Execution de la requête
        $preparedRequest->execute($admin);
    // Retour des infos de tous les utilisateurs sous forme de liste 
        return $preparedRequest->fetchAll(PDO::FETCH_ASSOC);
    }



    // Fonction pour afficher tous les livres 
    public static function allBooks()
    {
        // Lecture de tout un fichier dans une chaîne : file_get_content
        // Récupération de tous les livres
        $googleBooksJson = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=nausicaa&key='.API_KEY);
        
        // Traduction d'une chaîne JSON en PHP : json_decode
        $googleBooksPhp = json_decode($googleBooksJson, true);
        
        
            return $googleBooksPhp;
    }


    

    







}








?>
