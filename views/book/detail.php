<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
//     print_r ($detailLivre);
// echo "</pre>";

?>

<main>

    <div id="livre" class="container">
        <h1 class="m-5"><?=$detailLivre["title"]?></h1>

        <div class="container-fluid">
            <div class="row">
                <ul class="col-7 text-decoration-none">
                    <li>Titre : <?=$detailLivre["title"]?></li>
                    <li>Auteur : 
                        <?php
                        for($i=0; $i<count($detailLivre["authors"]); $i++){
                            if($i+1 == count($detailLivre["authors"])){
                                echo $detailLivre["authors"][$i]; 
                            }else{
                                echo $detailLivre["authors"][$i] . ", "; 
                            }           
                        }       
                        ?>
                    </li>
                    <li>Editeur: <?=$detailLivre["publisher"]?></li>
                    <li>Date de parution : <?=substr($detailLivre["publishedDate"],0,10)?></li>
                    <li>Résumé : <?=(isset($detailLivre["description"]))?$detailLivre["description"]:"Description non disponible";?></li>
                    <li>ISBN : <?=$detailLivre["industryIdentifiers"][1]["identifier"]?></li>
                    <li>Genre : 
                        <?php
                            if(isset($detailLivre["categories"])){
                                for($i=0; $i<count($detailLivre["categories"]); $i++){
                                    if($i+1 == count($detailLivre["categories"])){
                                        echo $detailLivre["categories"][$i]; 
                                    }else{
                                        echo $detailLivre["categories"][$i] . ", "; 
                                    }  
                                }                    
                            }else{
                                echo "Non spécifié";
                            }
                        ?>
                    </li>
                    <li>Pages : <?=$detailLivre["pageCount"]?></li>
                </ul>
                <div class="photo col-5">
                    <?php
                        if(!isset($detailLivre["imageLinks"])){
                    ?>
                        <img class="w-100" src="<?=COVER?>couverture/couverture_non_dispo.png" alt="couverture non disponible">
                    <?php
                        }else{
                    ?>
                        <img src="<?=$detailLivre["imageLinks"]["thumbnail"];?>" alt="couverture de <?=$detailLivre["title"];?>">
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <a href="<?=BASE_PATH?>listeLivres" class="btn btn-success mx-5">Retour à la liste des livres</a>

        <a href="<?=BASE_PATH.'addSouhait?id='.$_GET['id']?>" class="btn btn-primary mx-5">Ajouter à ma liste de souhaits</a>
        <a href="<?=BASE_PATH.'addOffre?id='.$_GET['id']?>" class="btn btn-warning mx-5">Ajouter à ma liste d'offres</a>


    </div>

<main>






<?php  include VIEWS.'inc/footer.php'; ?>