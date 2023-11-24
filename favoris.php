<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>



<div class="container text-center">

   <div class="row row-cols-1 row-cols-lg-3 g-2 g-lg-3">

    <?php

      $requete = $bdd -> prepare("SELECT * FROM jeux INNER JOIN favories ON jeux.id = favories.id_jeux WHERE favories.id_users = ?");
      $requete -> execute(array($_SESSION["id"]));
      if(($requete->rowCount()) == 0)
      {
        echo "\n\n\n\n\n Aucun jeu en favorie ";
      }
      while($jeu = $requete->fetch())
      {
        $description =  substr($jeu["description"], 0,500); ?>
        <div class="col">
          <a href="<?= "jeu.php?nom=".$jeu["nom"] ;?>">

          <div class="card" style="width: 20rem;">
            <img class="card-img-top" src="image/jeux/<?= $jeu["image"] ;?>">
            <div class="card-body">
              <h3><?= $jeu["nom"]; ?></h3>
              <p><?= $description ?></p>
            </div>
            
          </div>
        </a>
        </div>
        
      <?php
      }
    ?>

  </div>
</div>

<?php include("code/piedPage.html") ?>