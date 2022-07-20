<?php // Test déconnexion, à retirer et mettre dans le head (pareil pour l.50)
if(isset($_SESSION["pseudo"]) && isset($_GET["deconnexion"])){
    UserController::deconnexion($_GET["deconnexion"]);
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site d'echange de livres d'occasion avec systeme de points">
    <title>smartReader le site de vente de livres d'occasion</title>

    <!------------------------------ GOOGLE FONT LOBSTER/BEBAS NEUE/ROWDIES/GLORIA HALLELULLAH ------------------------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Gloria+Hallelujah&family=Lobster&family=Rowdies:wght@300;400&display=swap" rel="stylesheet">

    <!--------------------- links bootstrap et style--------------------------------------------------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!----------------------- Links salima------------------------->
    <!-- <link rel="stylesheet" type="text/css" href="../../asset/css/roboto-font.css"> -->
	  <link rel="stylesheet" type="text/css" href="<?=ASSET?>css/fonts/font-awesome-5/css/fontawesome-all.min.css">
    <!------------------------------------------------------------->

    <link rel="stylesheet" href="<?=ASSET?>css/style.css">
</head>
<body>                
<!-- HEADER -->

<!-------------------------------------------------LOG0-------------------------------------------- -->
  <header id="header">

    <div class="logo-banniere d-flex">

      <div class="logo">
        <a href="<?= BASE_PATH?>">
          <img src="<?=ASSET?>images/logoFinalPlus3Px.png" width="150px" height="150 px" alt="logo_de_la_marque"></a>
      </div>

<!--------------------------------- BANNIERE-------------------------------------------------- -->   
      <div class="banniere d-flex">    
        <h1 class="titreSite">Le site d'échanges de livres d'occasion</h1>
      </div>
      <h3 class="quote">La connaissance ne sera jamais une question de prix</h3>
    </div>

<!------------------------------------ Mascotte img-------------------------------------------- -->

      <div class="mascotte4 d-flex">
        <img src="<?=ASSET?>images/mascotte4.png" width="150px" height="150px" alt="image_mascotte_hibou">
      </div>
        
<!---------------------------------------Navbar------------------------------------------------  -->

      <nav class="navbar navbar-expand-lg navbar-light bg-light colornav">

        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- Pas connecté -->
              <?php if(!User::isConnected()){?>
                <li class="nav-item">
                  <a class="nav-link active a-btn" aria-current="page" href="<?= BASE_PATH . "inscription" ?>">S'inscrire</a>
                </li>
              <?php } ?>

              <?php if(!User::isConnected()){?>
                <li class="nav-item">
                  <a class="nav-link a-btn" href="<?= BASE_PATH . "connexion" ?>">Se connecter</a>
                </li>
              <?php } ?>

              <!-- Connecté -->
              <?php if(User::isConnected()){?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle a-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Mon compte
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= BASE_PATH . "monCompte" ?>">Mon profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= BASE_PATH . "mesSouhaits" ?>">Mes demandes</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_PATH . "mesOffres" ?>">Mes offres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= BASE_PATH . "monHistorique" ?>">Echanges conclus</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item fw-bold" href="?deconnexion=ok" ?>Deconnexion</a></li>

                  </ul>
                </li>
              <?php } ?>

              <?php if(AdminController::isAdmin()){?>
                <li class="nav-item dropdown"> 
                  <a class="nav-link dropdown-toggle a-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin
                  </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="<?= BASE_PATH . "listUsers" ?>">Liste des utilisateurs</a></li>
                      <li><a class="dropdown-item" href="<?= BASE_PATH . "allOffres" ?>">Liste des offres</a></li>
                      <li><a class="dropdown-item" href="<?= BASE_PATH . "allSouhaits" ?>">Liste des demandes</a></li>
                      <li><a class="dropdown-item" href="<?= BASE_PATH . "allHistorique" ?>">Historique des Echanges</a></li>
                    </ul>

                </li>
              <?php } ?>


              <?php if(User::isConnected()){?>
                <li class="nav-item"> 
                  <a class="nav-link a-btn" href="<?=BASE_PATH . "allOffres"?>" ?>Livres disponibles</a>
                </li>
              <?php } ?>

              <?php if(User::isConnected()){?>
                <li class="nav-item"> 
                  <a class="nav-link a-btn" href="<?=BASE_PATH . "allSouhaits"?>" ?>Livres demandés</a>
                </li>
              <?php } ?>

              <!-- Tout le monde -->
              <li class="nav-item">
                <a class="nav-link a-btn" href="<?= BASE_PATH . "contact" ?>">Nous contacter</a>
              </li>

            </ul>

            <form action="<?=BASE_PATH . "listeLivres"?>" method="post" class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Livre, Auteur,ISBN" aria-label="Rechercher" name="search">
              <button class="btn btn-outline-success btncolor" type="submit">Rechercher</button>
            </form>

          </div>
        </div>
            
            
      </nav>

  </header>
