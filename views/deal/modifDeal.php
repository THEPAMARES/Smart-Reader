<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
    // print_r($_GET);
    print_r($oneDealArray);
    // print_r($deal);
    // print_r($_SESSION);
    // print_r($_POST);
// echo "</pre>";
?>
<main>
    <div class="main">
        <h1 class='text-center'>Modifier <?=$title?></h1>

        <h2><?=$detailLivre["title"]?></h2>

        <div class="container-fluid">
            <div class="row">
                <ul class="col-7 text-decoration-none">
                    <li>Titre : <?=$detailLivre["title"]?></li>
                    <li>Auteur : 
                        <?php
                        for($i=0; $i<count($detailLivre["authors"]); $i++)
                            if($i+1 == count($detailLivre["authors"])){
                                echo $detailLivre["authors"][$i]; 
                            }else{
                                echo $detailLivre["authors"][$i] . ","; 
                            }                  
                        ?>
                    </li>
                    <li>Editeur: <?=$detailLivre["publisher"]?></li>
                    <li>Date de parution : <?=$detailLivre["publishedDate"]?></li>
                    <li>ISBN : <?=$detailLivre["industryIdentifiers"][1]["identifier"]?></li>
                    <li>Etat : <?=$etat?></li>
                    <li>Genre : 
                    <?php
                        if(isset($detailLivre["categories"])){
                            for($i=0; $i<count($detailLivre["categories"]); $i++){
                                if($i+1 == count($detailLivre["categories"])){
                                    echo $detailLivre["categories"][$i]; 
                                }else{
                                    echo $detailLivre["categories"][$i] . ","; 
                                }  
                            }                    
                        }else{
                            echo "Non spécifié";
                        }
                    ?>
                    <?php
                        if(isset($detailLivre["categories"])){
                            for($i=0; $i<count($detailLivre["categories"]); $i++){
                                if($i+1 == count($detailLivre["categories"])){
                                    echo $detailLivre["categories"][$i]; 
                                }else{
                                    echo $detailLivre["categories"][$i] . ","; 
                                }  
                            }                    
                        }else{
                            echo "Non spécifié";
                        }
                    ?>
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


        <form action="" method="post">
            <label for="etat" class='d-block'>Etat du livre</label>
            <select name="etat" id="etat">
                <option value="mauvais" <?=$point==1? "selected":""?>>Abîmé - 1 point</option>                
                <option value="bon" <?=$point==2? "selected":""?>>Bon - 2 points</option>
                <option value="neuf" <?=$point==3? "selected":""?>>Neuf - 3 points</option>
                <option value="rare" <?=$point==4? "selected":""?>>Rare - 4 points</option>
            </select>

            <input type="submit" class="btn btn-primary" value="Modifier">

            <a href="<?=BASE_PATH.$cancelModifRoad;?>" class="btn btn-danger">Annuler</a>

        </form>


    </div>

</main>

<?php  include VIEWS.'inc/footer.php'; ?>