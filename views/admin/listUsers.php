<?php  

include VIEWS.'inc/header.php';

// echo "<pre>";
  // print_r($users);
//   print_r($_GET);
// echo "</pre>";
?>

<main>
  <!-- Affichage Liste users -->
  <h1 class="text-center my-5">Liste des Utilisateurs</h1>


  <!-- <div class='container'> -->
    <table class="table text-center container" id="tftable">
      <thead>
        <tr>
          <th scope="col-1">id_user</th>
          <th scope="col-1">Nom</th>
          <th scope="col-1">Prenom</th>
          <th scope="col-1">Pseudo</th>
          <th scope="col-1" class="colonneNone">Email</th>
          <th scope="col-1" class="colonneNone">Date d'anniversaire</th>
          <th scope="col-1" class="colonneNone">Adresse</th>
          <th scope="col-1" class="colonneNone">Date d'inscription</th>
          <th scope="col-1">Points</th>
          <th scope="col-1">Photo</th>
          <th scope="col-1">Admin</th>
          <th scope="col-1">Disabled</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
            <?php
            foreach($users as $user){
            ?>
        <tr>
          <th scope="row"><?= $user['id_user']?></th>
          <td><?= $user['name']?></td>
          <td><?= $user['firstname']?></td>
          <td><?= $user['pseudo']?></td>
          <td class="colonneNone"><?= $user['email']?></td>
          <td class="colonneNone"><?= $user['birthdate']?></td>
          <td class="colonneNone"><?= $user['address']?></td>
          <td class="colonneNone"><?= $user['inscription_date']?></td>
          <td><?= $user['point']?></td>
          <td>
              <img  class="photoProfil" src="<?=COVER.'photo_profil/'.$user['photoRoad'][1]?>" alt="photo profil de <?=$user['pseudo']?>">
          </td>
          <td><?= $user['admin'] ? "Admin" : ""?></td>
          <td><?= $user['disabled'] ? "Disabled" : ""?></td>
          <td class="align-middle">
                <a href="<?="?adminUser=ok&&id_user=" . $user['id_user']?>" class="btn btn-warning">Ad.</a>
          </td>
          <td class="align-middle">
                <a href="<?="?disableUser=ok&&id_user=" . $user['id_user']?>" class="btn btn-secondary">Dis.</a>
          </td>
          <td class="align-middle">
                <a href="<?="?deleteUser=ok&&id_user=" . $user['id_user']?>" class="btn btn-danger">Suppr</a>
          </td>

        </tr>
            <?php
        }
            ?>
      </tbody>
    </table>
  <!-- </div> -->
</main>

<?php  include VIEWS.'inc/footer.php'; ?>