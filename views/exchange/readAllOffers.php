<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
//     print_r($_GET);
    // print_r($infoUser);
    // print_r($listAllOffres);
// echo "</pre>";
?>

<main class="container">
    <h1 class="text-center">Liste de toutes les offres</h1>

    <div class="point alert alert-primary w-50 m-auto my-5" role="alert">
        Vous possédez : <?= $point?> point(s). 
    </div>
    
    <?php
        if(empty($listAllOffres)){
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
                <th scope="col">Date de l'offre</th>
                <th scope="col">Titre du livre</th>
                <th scope="col">Auteur</th>
                <th scope="col" class="colonneNone">Editeur</th>
                <th scope="col" class="colonneNone">Etat</th>
                <th scope="col">Point(s)</th>
                <th scope="col">Possesseur</th>
                <th scope="col">Modifier</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($listAllOffres as $offre){

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
                        <td><?=$offre['user'][0]["pseudo"]?></td>
                        <td><a href="<?=BASE_PATH."tradeDetail?idLivre=".$offre['id_book']."&&idDeal=".$offre['id_deal']?>" class="btn btn-success">Details</a></td>
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