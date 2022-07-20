<?php

class AppController
{

    public static function index()
    {
        include VIEWS . "app/home.php";
    }

    public static function legal()
    {
        include VIEWS . "app/mentions_legales.php";
    }

    public static function who()
    {
        include VIEWS . "app/qui_sommes_nous.php";
    }


    public static function contact(){

        if(!empty($_POST)){
            $email=$_POST["email"];
            $objet=$_POST["objet"];
            $message=$_POST["message"];
            $msg="";
            
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';

            if(Contact::verifEmail($_POST['email'])){

                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Le champs email n'est pas bien renseigné
                </div>";

            }

            if(Contact::verifObjet($objet)){

                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                L'objet n'est pas renseigné
                </div>";

            }

            if(Contact::verifMessage($message)){

                $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                Le champs message est vide
                </div>";

            }

            if(empty($msg)){

                if(Contact::messageContact($message)){

                    $msg .= "<div class=\"alert alert-success\" role=\"alert\">
                    Le mail a bien été envoyé
                    </div>";

                } else {

                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Une erreur est survenue, le email n'a pas été envoyé
                            </div>";
                    
                }
            }
    }

        include VIEWS . "app/contact.php";

    }
    
}

