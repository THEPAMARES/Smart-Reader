<?php

// echo "<pre>";
    // print_r($acquisitionList);
    // print_r($cessionList);
// echo "</pre>";
include VIEWS.'inc/header.php'; 

?>


<main class="container">
    <h1 class="text-center m-5">Liste de toutes mes acquisitions</h1>

    <table class="table m-3" id="tftable">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Date</th>
                <th scope="col">Vendeur</th>
                <th scope="col">Titre du livre</th>
                <th scope="col">Point(s)</th>
                <th scope="col">N° du deal</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($acquisitionList as $acquisition){

            ?>
                <tr>
            
                        <th scope="row"><?=$acquisition['id_exchange']?></th>
                        <td><?=$acquisition['purchase_date']?></td>
                        <td><?=$acquisition['id_owner'] . " - " . $acquisition["owner"][0]['pseudo']?></td>
                        <td><?=$acquisition['api']['volumeInfo']['title']?></td>
                        <td><?=$acquisition["dealing_point"]?></td>
                        <td><?=$acquisition['id_deal']?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

    <h1 class="text-center m-5">Liste de toutes mes ventes</h1>

    <table class="table m-5" id="tftable">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Date</th>
                <th scope="col">Acheteur</th>
                <th scope="col">Titre du livre</th>
                <th scope="col">Point(s)</th>
                <th scope="col">N° du deal</th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($cessionList as $cession){

            ?>
                <tr>
            
                        <th scope="row"><?=$cession['id_exchange']?></th>
                        <td><?=$cession['purchase_date']?></td>
                        <td><?=$cession['id_purchaser'] . " - " . $cession["purchaser"][0]['pseudo']?></td>
                        <td><?=$cession['api']['volumeInfo']['title']?></td>
                        <td><?=$cession["dealing_point"]?></td>
                        <td><?=$cession['id_deal']?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</main>
<?php  include VIEWS.'inc/footer.php'; ?>
