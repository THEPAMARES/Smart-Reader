<?php

class BookController
{

    public static function booksListing()
    {
    // Récupération de la liste info 
        // $listeLivres = Book::allBooks();
    
    // Si pas de POST, renvoie à la liste des offres
        if(empty($_POST)){
            header("location:".BASE_PATH."allOffres");
            exit;
        }

        if(!empty($_POST)){
            $recherche=str_replace(' ', '+', $_POST["search"]);
            $booksFound = Book::searchBooks($recherche);
            $booksItem = $booksFound["items"];
        }


        include VIEWS . "book/list.php";
    }

    public static function bookDetail()
    {
    // Récupération détail d'un livre 
        $livreInfo = Book::oneBook($_GET['id']);
        $detailLivre = $livreInfo["volumeInfo"];

        include VIEWS . "book/detail.php";
    }











}
?>