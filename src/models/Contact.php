<?php

class contact{

    public static function verifEmail($email){

        //on vérifie que le champ mail est correctement rempli
        if(empty($email)) {

            return true;
            
        }else{

            //on vérifie que l'adresse est correcte
            if(!preg_match("#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i",$email)){

                return true;

            }
        }

    }

    public static function verifObjet($objet){

        //on vérifie que le champ objet est correctement rempli
        if(empty($objet)) {

            return true;
        }
    }

    public static function verifMessage($message){

        //on vérifie que le champ message n'est pas vide
        if(empty($message)) {

            return true;
        }
    }

    public static function messageContact($mail){
        //notre adresse mail
        $AdresseMail="smartreaderprojet@gmail.com";

        //tout est correctement renseigné, on envoi le email
        //on renseigne les entêtes de la fonction email de PHP
        $Entetes = "MIME-Version: 1.0\r\n";
        $Entetes .= "Content-type: text/html; charset=UTF-8\r\n";
        $Entetes .= "From: Smart Reader <".$AdresseMail.">\r\n";
        //de préférence une adresse avec le même domaine de là où, vous utilisez ce code, cela permet un envoie quasi certain jusqu'au destinataire

        $Entetes .= "Reply-To: Smart Reader <".$_POST['email'].">\r\n";

        //on prépare les champs:
        $email=$_POST['email']; 
        $Objet='=?UTF-8?B?'.base64_encode($_POST['objet']).'?=';
        //Cet encodage (base64_encode) est fait pour permettre aux informations binaires d'être manipulées par les systèmes qui ne gèrent pas correctement les 8 bits (=?UTF-8?B? est une norme afin de transmettre correctement les caractères de la chaine)
        $message=$_POST['message'];
        $mail=htmlentities($_POST['message'],ENT_QUOTES,"UTF-8");
        //htmlentities() converti tous les accents en entités HTML, ENT_QUOTES Convertit en + les guillemets doubles et les guillemets simples, en entités HTML

        //la fonction nl2br permet de conserver les sauts de ligne et la fonction base64_encode de conserver les accents dans le titre

        //enfin, on envoi le email
        if(mail($AdresseMail,$Objet,nl2br($message),$Entetes)){

            return true;
        }

        return false;
    }

}
