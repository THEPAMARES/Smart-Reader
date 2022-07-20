<?php  

include VIEWS.'inc/header.php';

// echo "<pre>";
//     print_r($listeLivres);
//     print_r($_POST);
// echo "</pre>";

?>

<main>
    <h1 class="m-5">Résultats de votre recherche</h1>
    
    <!-- Affichage livres -->
    <?php
    if(!empty($_POST)){
        foreach($booksItem as $book){
    ?>


    <div class="card bookCard" style="width: 18rem;">
        <?php
            if(!isset($book["volumeInfo"]["imageLinks"])){
        ?>
            <img class="card-img-top" src="<?=COVER?>couverture/couverture_non_dispo.png" alt="couverture non disponible">
        <?php
            }else{
        ?>
            <img class="card-img-top" src="<?=$book["volumeInfo"]["imageLinks"]["thumbnail"];?>" alt="couverture de <?=$book["volumeInfo"]["title"];?>">
        <?php
            }
        ?>
        <div class="card-body">
            <h5 class="card-title"><?=$book["volumeInfo"]["title"]?></h5>
            <p class="card-text">
                <?php
                    if(!isset($book["volumeInfo"]["authors"])){
                ?>
                    Auteur non connu
                <?php
                    }else{
        
                        for($i=0; $i<count($book["volumeInfo"]["authors"]); $i++){
                            if($i+1 == count($book["volumeInfo"]["authors"])){
                                echo $book["volumeInfo"]["authors"][$i]; 
                            }else{
                                echo $book["volumeInfo"]["authors"][$i] . ","; 
                            }   
                        }         
                    }      
                ?>
            </p>
            <p><?=substr($book["volumeInfo"]["publishedDate"],0,4)?></p>
            <a href="<?=BASE_PATH.'detailLivre?id='.$book['id']?>" class="btn btn-primary">Détails</a>
        </div>
    </div>

<?php
    }
}
?>




</main>










<?php  include VIEWS.'inc/footer.php'; ?>