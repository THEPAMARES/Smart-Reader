<?php  include VIEWS.'inc/header.php'; ?>

<!-- --------------------------------------code de la page --------------------------------------------------->

<?php
    if(isset($_COOKIE["success"])){
?>
    <div class="alert alert-success m-5 w-75 mx-auto" role="alert"><?=$_COOKIE["success"]?></div>

<?php
    }
?>

<?php
    if(isset($_COOKIE["disconnect"])){
?>
    <div class="alert alert-success m-5 w-75 mx-auto" role="alert"><?=$_COOKIE["disconnect"]?></div>

<?php
    }
?>


<!----------------------------- slider carroussel bootstrap ---------------------------->
        <container class="slider">

                <div id="carouselExampleSlidesOnly" class="carousel slide mx-auto col-8 " data-bs-ride="carousel">
                   
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="<?=ASSET?>images/ccmimg.jpg" class="d-block w-100" alt="visuel commentCaMarche">
                    </div>
                    <div class="carousel-item">
                        <img src="<?=ASSET?>images/sliderpourquoi.jpg" class="d-block w-100" alt="visuel pourquoiSmartReader">
                    </div>
                    <div class="carousel-item">
                        <img src="<?=ASSET?>images/slider-quote.jpg" class="d-block w-100" height=""alt="livreOuvertHistoireFar">
                    </div>
                </div>
            </div>

        </container>

                                <!---------------------------- COMMENT CA MARCHE H2------------------------->




            <h2 class="resumeSite">Facile, économique et écologigue, l'échange de livres d'occasion vous permet de lire de nouveaux ouvrages toute l'année. Inscrivez-vous gratuitement et ajoutez vos livres à notre catalogue composé de milliers d'ouvrages.</h2>
         <container class="boites d-flex" >

             <div>
                 <img src="<?=ASSET?>images/mascotte6.png" width="150px" height="150px"alt=" image-mascotte-hibou">
             </div>
             <div class="boite1 d-flex">
                 <p class="p1">"Bonjour, je te propose un bon plan pour lire toute l'année sans rien débourser"</p>
             </div>

             <div>
                <img src="<?=ASSET?>images/mascotte4.png" width="150px" height="150px"alt="image-mascotte-hibou">
            </div>
             <div class="boite2 d-flex">
                 <p class="p2">"Echange tes livres contre des points et choisis d'autres livres"</p>
             </div>
             <div>
           
             <img src="<?=ASSET?>images/mascotte8.png" width="150px" height="150px"alt=" image-mascotte-hibou">
            </div>
             <div class="boite3 d-flex">
                <p>"Pour cela tu peux simplement proposer tes livres en écrivant le code ISBN"</p>
             </div>
             
             
         </container> 


<?php  include VIEWS.'inc/footer.php'; ?>
