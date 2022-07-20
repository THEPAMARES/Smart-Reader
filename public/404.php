<?php

// if (!session_status()) session_start();
// $_SESSION['messages']['danger'][] = "La page demandée n'existe pas.";
// //AppController::index();// html page 404
?>
<?php
include VIEWS . "inc/header.php";


?>
<style>
  header,
  footer {
    display: none;
  }
</style>
<main class="page-404">
  <div class="text">
    <div>ERREUR</div>
    <h1>404</h1>
    <hr>
    <div>Page Non trouvée</div>
      <a href="<?=BASE_PATH?>" class="display-5 text-info">>> Retour à l'accueil <<</a>

  </div>

  <div class="mascotte404">

    <img src="<?= ASSET ?>images/mascotte1.png" alt="Mascotte qui flotte" class="src">
  </div>

</main>



<?php include VIEWS . "inc/footer.php";?>
