<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
    // print_r($_GET);
    // print_r($listeDemandes);
    // print_r($_SESSION);
    // print_r($_POST);
// echo "</pre>";
?>

<main class="container">
    <h1 class="text-center m-5">Liste de mes demandes</h1>

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
        // Si listeDemandes est vide affiche message
        if(empty($listeDemandes)){
    ?>
        <div class="noRequest">
            <p><?=$msg1?></p>
        </div>
    <?php
        //Sinon affiche tableau
        }else{
    ?>

    <table class="table" id="tftable">
        <thead>
            <tr>
            <th scope="col">Date de la demande</th>
            <th scope="col">Titre du livre</th>
            <th scope="col">Auteur</th>
            <th scope="col">Editeur</th>
            <th scope="col">Etat</th>
            <th scope="col">Point(s)</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($listeDemandes as $demande){

            ?>
                <tr>
            
                        <th scope="row"><?=substr($demande['dealing_date'],0,10);?></th>
                        <td><?=$demande['api']['volumeInfo']['title']?></td>
                        <td>
                            <?php
                            for($i=0; $i<count($demande['api']['volumeInfo']["authors"]); $i++)
                                if($i+1 == count($demande['api']['volumeInfo']["authors"])){
                                    echo $demande['api']['volumeInfo']["authors"][$i]; 
                                }else{
                                    echo $demande['api']['volumeInfo']["authors"][$i] . ","; 
                                }                  
                            ?>
                        </td>
                        <td><?=$demande['api']['volumeInfo']['publisher']?></td>
                        <td><?=$demande["etat"]?></td>
                        <td><?=$demande["point_offers"]?></td>
                        <td><a href="<?=BASE_PATH.'modifDeal?deal='.$demande['id_deal']?>" class="btn btn-warning">Modifier</a></td>

                        <td>
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprCompte">
                                Supprimer
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
                                            <p>Vous allez supprimer <?=$demande['api']['volumeInfo']['title']?> de votre liste de souhaits. Voulez-vous continuer?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="?id=<?=$demande['id_deal']?>&&deleteDeal=ok" class="btn btn-danger">Continuer</a>
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