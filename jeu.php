<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php 
  $requete = $bdd->prepare("SELECT * FROM jeux WHERE nom = ?");
  $requete->execute(array($_GET['nom']));
  $jeu = $requete ->fetch();
?>

<?php 
if(isset($_POST["desinscription"]))
{
  $eventExist= $bdd->prepare("SELECT * FROM planning WHERE id= ? ");
  $eventExist->execute(array($_POST["desinscription"]));
  $exist = $eventExist->rowCount();
  if($exist==1)
  {
    $desinscription= $bdd->prepare("DELETE FROM inscription WHERE id_users=? AND id_planning=?");
    $desinscription->execute(array($_SESSION['id'],$_POST["desinscription"]));
  }

}


 ?>


<?php 
if(isset($_POST["sinscription"]))
{
  $eventExist= $bdd->prepare("SELECT * FROM planning WHERE id= ? ");
  $eventExist->execute(array($_POST["sinscription"]));
  $exist = $eventExist->rowCount();
  if($exist==1)
  {
    $desinscription= $bdd->prepare("INSERT INTO inscription(id_users,id_planning) VALUES(?,?)");
    $desinscription->execute(array($_SESSION['id'],$_POST["sinscription"]));
  }

}
?>

<?php 
if(isset($_POST["addFavorie"]))
{

  $addFav= $bdd->prepare("INSERT INTO favories(id_users,id_jeux) VALUES(?,?)");
  $addFav->execute(array($_SESSION['id'],$jeu["id"]));

}
?>

<?php 
if(isset($_POST["suppFavorie"]))
{
  $suppFav= $bdd->prepare("DELETE FROM favories WHERE id_users=? AND id_jeux=?");
  $suppFav->execute(array($_SESSION['id'],$jeu["id"]));
}

?>

<section>

  <div class="card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
      <img src="image/jeux/<?= $jeu["image"] ;?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $jeu["nom"]; ?></h5>
        <p class="card-text"><?= $jeu["description"]?></p>
        <p class="card-text"><a  href="document/regle/<?= $jeu["nom"]; ?>.pdf" >Règle du jeu</a></p>
        <?php
          $reqFavorie = $bdd->prepare("SELECT id FROM favories WHERE id_users= ? AND id_jeux = ?  ");
          $reqFavorie->execute(array($_SESSION['id'], $jeu["id"]));
          $countFavorie = $reqFavorie->rowCount();
          if ($countFavorie == 0)
          { ?>
            <form method="POST"> <button name="addFavorie"type="submit">Ajouter aux favories</button>  </form> 
          <?php }
          else
          { ?>
            <form method="POST"> <button name="suppFavorie"type="submit">Supprimer des favories</button>  </form> 
          <?php } ?> 
      </div>
    </div>
  </div>
</div>


</section>
<section>
  <div>
    <h2 align="center">Evènement à venir </h2><br>
    <table id="planning" align="center" class="table table-striped" >
      <thead>
          <tr>
            <th colspan="6">Mon planning</th>
          </tr>
        </thead>
        <tr>
          <td align="center">Jeux</td>
          <td align="center">Date</td>
          <td align="center" >Temps</td>
          <td align="center">Niveau</td>
          <td align="center">Place</td>
          <td align="center">Inscription</td>
        </tr>
      <?php     

        $reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id_jeux = ? ");
        $reqEvent->execute(array($jeu["id"]));
        while ($event = $reqEvent->fetch()) 
        { 
          $reqInscrit = $bdd->prepare("SELECT * FROM inscription WHERE id_planning= ? ");
          $reqInscrit->execute(array($event["id"]));
          $countInscrit = $reqInscrit->rowCount();
          $reqInscription = $bdd->prepare("SELECT * FROM inscription WHERE id_planning= ? AND id_users= ? ");
          $reqInscription->execute(array($event["id"], $_SESSION['id']));
          $Inscription = $reqInscription->rowCount();

        ?>
          <tr>
            <td align="center">  <?= $jeu['nom'] ?>  </td>
            <td align="center">  <?= $event['dateDebut'] ?>  </td>
            <td align="center">  <?= $event['duree'] ?> heures </td>
            <td align="center">  <?= $event['niveau'] ?>  </td>
            <td align="center">  <?= $countInscrit ?> /  <?= $event["places"] ?></td> <?php 
            if($Inscription != 0 ) // affiche inscrit
            { ?>
              <td align="center"><form method="POST"> <button value="<?= $event['id'] ?>" name="desinscription"type="submit">Se désinscrire </button>  </form> </td>
            <?php } 
            elseif( $countInscrit == $event["places"])// affiche complet
            { ?>
              <td align="center"> Complet </td>
            <?php } 
            elseif($Inscription == 0)
            { ?>
              <td align="center"><form method="POST"> <button value="<?= $event['id'] ?>" name="sinscription"type="submit"> S'inscrire </button>  </form> </td>
            <?php }  ?>
          </tr>
        <?php }
      ?>
     

    </table>
  </div>
</section>