    //Verif photo 

    function verifPhoto(){ // Pas besoin d'argument, car toutes les informations neccessaires sont dans la superglobal $_FILES, et que les superglobales sont aussi accessible dans les fonctions


        if ($_FILES["photo"]["type"] == "image/png"){
            return true;
        }
    
        if ($_FILES["photo"]["type"] == "image/jpeg"){
            return true;
        }
    
        if ($_FILES["photo"]["type"] == "image/jpg"){
            return true;
        }
    
    
            // Enregistrement de la photo, puis a l'enregistrement en bdd
    
            if (empty($msg)){
                // On ne procede a l'enregistrement que s'il n'y a pas de message d'erreurs
    
                $pseudo = $_POST["pseudo"];
    
                $cheminTelechargement = PHOTO . $pseudo . "-" . time() . "-" . $_FILES["photo"]["name"];
    
                if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $cheminTelechargement)){
                    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
                    Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement de votre fichier
            </div>";
                }
            }
    }
