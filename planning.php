<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php  $dateActuelle = date("Y-m-d H:i:s");?>


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
if(isset($_POST["sinscrire"]))
{
  $eventExist= $bdd->prepare("SELECT * FROM planning WHERE id= ? ");
  $eventExist->execute(array($_POST["sinscrire"]));
  $exist = $eventExist->rowCount();
  if($exist==1)
  {
    $desinscription= $bdd->prepare("INSERT INTO inscription(id_users,id_planning) VALUES(?,?)");
    $desinscription->execute(array($_SESSION['id'],$_POST["sinscrire"]));
  }

}
?>









<section>
  <div>
    <h2 align="center">Evènements à venir </h2><br>
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

        $reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE dateDebut > ? ");
        $reqEvent->execute(array($dateActuelle));
        while ($event = $reqEvent->fetch()) 
        { 
          $reqJeu = $bdd -> prepare("SELECT * FROM jeux WHERE id = ?");
          $reqJeu->execute(array($event["id_jeux"]));
          $jeu = $reqJeu->fetch();

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
              <td align="center"><form method="POST"> <button value="<?= $event['id'] ?>" name="sinscrire"type="submit"> S'inscrire </button>  </form> </td>
            <?php }  ?>
          </tr>
        <?php }
      ?>
     

    </table>
  </div>
</section>