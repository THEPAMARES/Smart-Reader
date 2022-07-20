<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
    // print_r($livreInfo);
//     print_r($listeOffres);
//     print_r($offre);
// echo "</pre>";
?>

<main class="container">
    <h1 class="text-center m-5">Liste de mes offres</h1>

    <?php
        if(isset($_COOKIE["modifDeal"])){
    ?>
        <div class="alert alert-success" role="alert"><?=$_COOKIE["modifDeal"]?></div>

    <?php
        }
    ?>

    <?php
        if(isset($_COOKIE["stockTitreLivre"])){
    ?>
        <div class="alert alert-success" role="alert">Le livre - <?=$_COOKIE["stockTitreLivre"]?> - a bien été ajouté à votre liste</div>

    <?php
        }
    ?>


    <?php
        if(empty($listeOffres)){
    ?>
        <div class="noRequest">
            <p><?=$msg1?></p>
        </div>
    <?php
        }else{
    ?>
    
    <table class="table" id="tftable">
        <thead>
            <tr>
                <th scope="col">Date de l'offre'</th>
                <th scope="col">Titre du livre</th>
                <th scope="col">Auteur</th>
                <th scope="col" class="colonneNone">Editeur</th>
                <th scope="col" class="colonneNone">Etat</th>
                <th scope="col">Point(s)</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($listeOffres as $offre){

            ?>
                <tr>
            
                        <th scope="row"><?=substr($offre['dealing_date'],0,10)?></th>
                        <td><?=$offre['api']['volumeInfo']['title']?></td>
                        <td>
                            <?php
                            for($i=0; $i<count($offre['api']['volumeInfo']["authors"]); $i++)
                                if($i+1 == count($offre['api']['volumeInfo']["authors"])){
                                    echo $offre['api']['volumeInfo']["authors"][$i]; 
                                }else{
                                    echo $offre['api']['volumeInfo']["authors"][$i] . ","; 
                                }                  
                            ?>
                        </td>
                        <td class="colonneNone"><?=$offre['api']['volumeInfo']['publisher']?></td>
                        <td class="colonneNone"><?=$offre["etat"]?></td>
                        <td><?=$offre["point_offers"]?></td>
                        <td><a href="<?=BASE_PATH.'modifDeal?deal='.$offre['id_deal']?>" class="btn btn-warning">Modif</a></td>
                        <td>
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprCompte">
                                Suppr
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="supprCompte" tabindex="-1" aria-labelledby="supprCompteLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="supprCompteLabel">Attention:</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Vous allez suppimer <?=$offre['api']['volumeInfo']['title']?> de votre liste de souhaits. Voulez-vous continuer?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="?id=<?=$offre['id_deal']?>&&deleteDeal=ok" class="btn btn-danger">Continuer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>

                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <?php
        }
    ?>
</main>

<?php  include VIEWS.'inc/footer.php'; ?>