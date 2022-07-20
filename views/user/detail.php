<?php  

include VIEWS.'inc/header.php'; 

// echo "<pre>";
//     print_r ($infoUser);
//     print_r ($_SESSION);
//     print_r ($_FILES);
// echo "</pre>";


?>
<main id="monCompte">

    <div id="monCompteCadre" class="container">
        <h1 id="titre" class="text-center">Mes informations</h1>

        <div class="container  informations">
            <div class="row flex-column-reverse flex-md-row justify-content-between">
                <ul class="col-md-5 text-decoration-none">
                    <li><span class="intitule">Nom : </span><?=$_SESSION['nom'];?></li>
                    <li><span class="intitule">Prenom : </span><?=$_SESSION['prenom'];?></li>
                    <li><span class="intitule">Pseudo: </span><?=$_SESSION['pseudo'];?></li>
                    <li><span class="intitule">Email : </span><?=$_SESSION['email'];?></li>
                    <li><span class="intitule">Date de naissance : </span><?=$_SESSION['birthdate'];?></li>
                    <li><span class="intitule">Adresse : </span><?=$_SESSION['address'];?></li>
                    <li><span class="intitule">Date d'inscription : </span><?=substr($_SESSION['inscription_date'],0,10);?></li>
                    <li><span class="intitule">Points : </span><?=$_SESSION['point'];?></li>
                </ul>

                <div class="photo col-md-5">
                    <img id="photo_profil" src="<?=COVER."photo_profil/".$_SESSION['readPhoto'][1]?>" alt="photo de profil de <?=$_SESSION['pseudo'];?>"> 
                </div>
            </div>
        </div>
        <div id="lien" class="row justify-content-md-evenly">
            <a id="btnModifProfil" href="<?=BASE_PATH?>modifCompte" class="btn btn-success mx-auto">Modifier mon profil</a>

            <!-- Button trigger modal : Pour confirmer la suppression de compte-->
            <button type="button" class="btn btn-danger mx-auto" data-bs-toggle="modal" data-bs-target="#supprCompte">
                Supprimer mon compte
            </button>

            <!-- Modal -->
            <div class="modal fade" id="supprCompte" tabindex="-1" aria-labelledby="supprCompteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="supprCompteLabel">Attention!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Vous êtes sur le point de supprimer votre compte, voulez-vous continuer?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="?supprimer=ok" class="btn btn-danger">Continuer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
</main>

<?php  include VIEWS.'inc/footer.php'; ?>