<?php
include VIEWS.'inc/header.php'; 
// echo '<pre>';
  // print_r($_POST);
  // print_r($_FILES);
//   print_r($mailExist);
//   print_r($pseudoExist);
// echo '</pre>';
?>

<main>

  <?=isset($msg)?$msg:""?>

  <div class="container-fluid" id='cadre'>
    <div class="image">
      <img src="<?=ASSET?>images/mascotte5.png">
    </div>
          <h1 class= "text-center">Inscription</h1>

          <form  method="post" enctype="multipart/form-data" class="mx-auto w-50" id="formInscription">
            <fieldset>
              
              <div class="form-group" >
                <label for="name" class="col-form-label col-form-label-lg mt-4"><font style="vertical-align: inherit;">Nom</font></label>
                <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?=!empty($_POST)?$_POST['name']:""?>">
              </div>

              <div class="form-group" >
                <label for="firstname" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;">Prénom</font></label>
                <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" value="<?=!empty($_POST)?$_POST['firstname']:""?>">
              </div>

              <div class="form-group" >
                <label for="pseudo" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Pseudo</font></label>
                <input type="text" class="form-control form-control-lg" id="pseudo" name="pseudo" value="<?=!empty($_POST)?$_POST['pseudo']:""?>">
              </div>

              <div class="form-group">
                <label for="pw" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;">Mot de passe</font></label>
                <input type="password" class="form-control form-control-lg" id="pw" name="pw">
              </div>

              <div class="form-group">
                <label for="email" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;">Adresse e-mail</font></label>
                <input type="email" class="form-control form-control-lg" id="email" aria-describedby="emailHelp" name="email" value="<?=!empty($_POST)?$_POST['email']:""?>">
              </div>

              <div class="form-group" >
                <label for="birthdate" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;">Date d'anniversaire</font></label>
                <input type="date" class="form-control form-control-lg" id="birthdate" name="birthdate" value="<?=!empty($_POST)?$_POST['birthdate']:""?>">
              </div>

              <div class="form-group" >
                <label for="address" class="col-form-label col-form-label-lg mt-1"><font style="vertical-align: inherit;">Adresse</font></label>
                <input type="text" class="form-control form-control-lg" id="address" name="address" value="<?=!empty($_POST)?$_POST['address']:""?>">
              </div>

              <div class="form-row">
                <label for="photo" class="form-label">Photo de profil</label>
                <input type="file" class="form-control" id="photo" name="photo">
              </div>


              </fieldset>

              <div class="form-row-last" id="btn">
                <input type="submit" name="register" class="register" value="Envoyer" id="btnInscription">
              </div>


              <!-- <button type="submit" class="btn btn-primary"><font style="vertical-align: inherit;">Valider</font></button> -->
            </fieldset>
          </form>
  </div>

</main>
<?php include VIEWS.'inc/footer.php'; ?>