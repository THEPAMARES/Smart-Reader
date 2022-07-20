<?php

// echo "<pre>";
    // print_r($echangeListe);
// echo "</pre>";
include VIEWS.'inc/header.php'; 

?>

<main class="container">
    <h1 class="text-center m-5">Liste de tous les échanges</h1>

    <table class="table" id="tftable">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Date</th>
                <th scope="col">Vendeur</th>
                <th scope="col">Titre du livre</th>
                <th scope="col">Acquéreur</th>
                <th scope="col">Point(s)</th>
                <th scope="col">N° du deal</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($echangeListe as $echange){

            ?>
                <tr>
            
                        <th scope="row"><?=$echange['id_exchange']?></th>
                        <td><?=substr($echange['purchase_date'],0,10)?></td>
                        <td><?=$echange['id_owner'] . " - " . $echange["owner"][0]['pseudo']?></td>
                        <td><?=$echange['api']['volumeInfo']['title']?></td>
                        <td><?=$echange['id_purchaser'] . " - " . $echange["purchaser"][0]['pseudo']?></td>
                        <td><?=$echange["dealing_point"]?></td>
                        <td><?=$echange['id_deal']?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</main>
<?php  include VIEWS.'inc/footer.php'; ?>
