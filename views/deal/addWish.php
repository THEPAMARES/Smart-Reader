<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
    // print_r($_GET);
    // print_r($livreInfo);
    // print_r($_SESSION);
    // print_r($_POST);
// echo "</pre>";
?>
<main>
    <div id="monCompteCadre" class="container">
        <h1 class='text-center'>Ajouter une demande</h1>
                
        <?=(isset($msg))?$msg:""?>

        <h2 class="m-4"><?=$detailLivre["title"]?></h2>

        <div class="container  informations">

            <div class="row flex-column-reverse flex-md-row justify-content-between">
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
                    <li>Pages : <?=$detailLivre["pageCount"]?></li>
                </ul>
                <div class="photo col-5">
                    <?php
                        if(!isset($detailLivre["imageLinks"])){
                    ?>
                        <img id="photo_profil" src="<?=COVER?>couverture/couverture_non_dispo.png" alt="couverture non disponible">
                    <?php
                        }else{
                    ?>
                        <img id="photo_profil" src="<?=$detailLivre["imageLinks"]["thumbnail"];?>" alt="couverture de <?=$detailLivre["title"];?>">
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="lien" class="row justify-content-md-evenly">
            
            <form action="" method="post" class="m-3">
                <label for="etat" class='d-block'>Etat du livre</label>
                <select name="etat" id="etat">
                    <option value="">--Veuillez sélectionner l'état de votre livre--</option>
                    <option value="mauvais">Abîmé - 1 point</option>                
                    <option value="bon">Bon - 2 points</option>
                    <option value="neuf">Neuf - 3 points</option>
                    <option value="rare">Rare - 4 points</option>
                </select>

                <input type="submit" class="btn btn-primary mx-auto w-25">

            </form>

        </div>
    </div>


</main>

<?php  include VIEWS.'inc/footer.php'; ?>