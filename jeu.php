<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php 
  $requete = $bdd->prepare("SELECT * FROM jeux WHERE nom = ?");
  $requete->execute(array($_GET['nom']));
  $jeu = $requete ->fetch();
?>

<section>
  
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
      
      <tr>


      <?php     

        $reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id_jeux = ? ");
        $reqEvent->execute(array($jeu["id"]));
        while ($event = $reqEvent->fetch()) { 
          $reqInscrit = $bdd->prepare("SELECT * FROM inscription WHERE id_planning= ? ");
          $reqInscrit->execute(array($event["id"]));
          $countInscrit = $reqInscrit->rowCount();
          $reqInscription = $bdd->prepare("SELECT * FROM inscription WHERE id_users= ? ");
          $reqInscription->execute(array($_SESSION['id']));
          $Inscription = $reqInscription->rowCount();

        ?>
          <td align="center">  <?= $jeu['nom'] ?>  </td>
          <td align="center">  <?= $event['dateDebut'] ?>  </td>
          <td align="center">  <?= $event['duree'] ?> heures </td>
          <td align="center">  <?= $event['niveau'] ?>  </td>
          <td align="center">  <?= $countInscrit ?> /  <?= $event["places"] ?></td> <?php 
          if($Inscription != 0 ) // affiche inscrit
          { ?>
            <td align="center"> Se désinscrire </td>
          <?php } 
          elseif( $countInscrit == $event["places"])// affiche complet
          { ?>
            <td align="center"> Complet </td>
          <?php } 
          elseif($Inscription == 0)
          { ?>
            <td align="center"> S'inscrire</td>
          <?php } 

           ?>
          
        <?php }
      ?>
      </tr>

    </table>
  </div>
</section>