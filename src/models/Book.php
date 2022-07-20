<?php

class Book extends Db
{

    // Fonction pour afficher tous les livres stockés dans l'API' 
    // public static function allBooks()
    // {

    //     // Lecture de tout un fichier dans une chaîne : file_get_content
    //     // Récupération de tous les livres
    //     $googleBooksJson = file_get_contents('https://www.googleapis.com/books/v1/volumes?q=nausicaa&key='.API_KEY);
        
    //     // Traduction d'une chaîne JSON en PHP : json_decode
    //     $googleBooksPhp = json_decode($googleBooksJson, true);
        
        
    //         return $googleBooksPhp;
    // }

    // Fonction pour afficher le détail d'un livre en particulier
    public static function oneBook($idLivre)
    {

        // Récupération d'un livre en particulier
        $OneBookJson = file_get_contents('https://www.googleapis.com/books/v1/volumes/'.$idLivre.'?key='.API_KEY);
        // URL temporaire pour test, à remplacé par une variable
        
        $OneBookPhp = json_decode($OneBookJson, true);
               
            return $OneBookPhp;
    }

    // Fonction pour recherche livre avec API google books 
    public static function searchBooks($searchRequest)
    {

        // Lecture de tout un fichier dans une chaîne : file_get_content (ne marche pas si je rajoute l'api key)
        $searchBooksJson = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$searchRequest."&maxResults=20&key=".API_KEY);
        
        // Traduction d'une chaîne JSON en PHP : json_decode
        $searchBooksPhp = json_decode($searchBooksJson, true);
        
        
            return $searchBooksPhp;
    }









}








?>
