<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
// print_r($_GET);
//     print_r($infoDeal);
//     print_r($_SESSION['id_user']);
//     print_r($proposer);
//     print_r($actor);
// echo "</pre>";
?>

<main class="container">

    <h1 class="text-center my-5">Détail de <?=$title?></h1>

    <?=isset($msgDisable)?$msgDisable:"";?>

    <h2><?=$detailLivre["title"]?></h2>

    <div class="container-fluid mx-auto">
        <div class="row">
            <ul class="col-7 text-decoration-none my-5">
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
                <li>Pages : <?=$detailLivre["pageCount"]?></li>
                <li><?=$userPosition?> : <?=$proposer[0]['pseudo'] ?></li>
                <li>Points : <?=$infoDeal[0]['point_offers'] ?></li>
            </ul>
            <div class="photo col-5 d-flex justify-content-center my-5">
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

    <div class="d-flex justify-content-around justify-content-md-center">
        <a href="<?=BASE_PATH.$chemin;?>"class="btn btn-danger">Retour</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success mx-5" data-bs-toggle="modal" data-bs-target="#confirmEchange" <?=!empty($msgDisable)?"disabled":"";?>>
            Accepter <?=$title?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="confirmEchange" tabindex="-1" aria-labelledby="confirmEchangeLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmEchangeLabel">Confirmation de l'échange</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Vous êtes sur le point de procéder à un échange.</p>
                        <p>Validez pour continuer.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a href="<?="?idDeal=".$_GET['idDeal']."&&echange=ok&&idLivre=".$livreInfo['id'];?>" class="btn btn-danger">Valider</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php  include VIEWS.'inc/footer.php'; ?>