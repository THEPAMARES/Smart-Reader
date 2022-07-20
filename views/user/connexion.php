<?php  

include VIEWS.'inc/header.php'; 

// echo"<pre>";   
//     print_r($infoUser);
    // print_r($disabledList);
// echo"</pre>";

?>

<main>

    <?=(isset($msg))?$msg:""?>
    <?php
        if(isset($_COOKIE["disabledAccount"])){
    ?>
        <div class="alert alert-danger" role="alert"><?=$_COOKIE["disabledAccount"]?></div>

    <?php
        }
    ?>

    <?php
        if(isset($_COOKIE["success"])){
    ?>
        <div class="alert alert-success" role="alert"><?=$_COOKIE["success"]?></div>

    <?php
        }
    ?>


    <div class="main">
        <h1 class="sign text-center">Se connecter</h1>
        
        <form class="form1" method="post">
            <input class="input text-center" type="text" placeholder="Nom utilisateur" name="pseudo">
            <input class="pass text-center text-dark" type="password"  placeholder="Mot de passe" name="mdp">
            <input class="submit btn btn-success text-center d-block mx-auto w-50" type="submit" value="Se connecter">
            <p class="forgot text-center"><a href="#">Mot de passe oublié?</a></p>
        
        </form>        
                                            
    </div>


</main>

<?php  include VIEWS.'inc/footer.php'; ?>