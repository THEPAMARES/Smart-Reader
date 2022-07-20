<?php

class AdminController
{

//Connection d'un admin
    public static function isAdmin(){

        if(!User::isConnected()){

            return false;
            
        }
        if($_SESSION['admin']==0){

            return false;
        }
        
        return true;
    }



//afficher les utilisateurs
    public static function usersListing(){
        $users = Admin::allUsers();

        //Récupération chemin photo :
        foreach($users as $cle=>$user){
            $users[$cle]['photoRoad'] = User::explodePhoto($users[$cle]['photo']);
        }
        
        //supprimer un user
        if(isset($_GET['deleteUser']) && $_GET['deleteUser'] == "ok"){
            Admin::deleteUser([
                'id_user'=>$_GET['id_user']
            ]);

            // Redirection accueil
            header("location:".BASE_PATH."listUsers");
            exit;
        }

        //passer un user en admin
        if(isset($_GET['adminUser']) && $_GET['adminUser'] == "ok"){
            $infoUser = User::getInfoUser([
                'id_user'=>$_GET['id_user']
            ]);

            if($infoUser["admin"]==0){
                Admin::adminUser([
                    "admin"=>1,
                    'id_user'=>$_GET['id_user']
                ]);
            }else{
                Admin::adminUser([
                    "admin"=>0,
                    'id_user'=>$_GET['id_user']
                ]);
            }
            // Redirection liste users
            header("location:".BASE_PATH."listUsers");
            exit;
            
        }

        //disable un user
        if(isset($_GET['disableUser']) && $_GET['disableUser'] == "ok"){
            $infoUser = User::getInfoUser([
                'id_user'=>$_GET['id_user']
            ]);

            if($infoUser["disabled"]==0){
                Admin::disabledSession([
                    "disabled"=>1,
                    'id_user'=>$_GET['id_user']
                ]);
            }
            if($infoUser["disabled"]==1){
                Admin::disabledSession([
                    "disabled"=>0,
                    'id_user'=>$_GET['id_user']
                ]);
            }


            // Redirection liste users
            header("location:".BASE_PATH."listUsers");
            exit;
        }
        
        //recuperation de la vue
        require VIEWS . "admin/listUsers.php";


    }


    //afficher les livres
    public static function booksListing(){
        $books = Admin::allBooks();

        //recuperation de la vue
        require VIEWS . "admin/listBooks.php";
    }











}
?>