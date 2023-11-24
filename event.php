<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>

<?php 

  if($_SESSION["role"]!= 1)
  {
    header("Location: index.php");
  }
?>
<?php 
  $idPlanning = $_GET['id'];

?>
<?php
if (isset($_POST["suppInscription"])) {

  $desinscription = $bdd->prepare("DELETE FROM inscription WHERE id_users = ? AND id_planning = ?");
  $desinscription->execute(array($_POST["suppInscription"], $idPlanning));

  $messageAnnulation = "Bonjour <br> Nous sommes désolé de vous annoncer nous vous avons retiré d'une de vos séance, car vous ne n'avez pas le niveau";
  $messageSupp = $bdd->prepare("INSERT INTO message(id_users, objet, message) VALUES (?, 'Suppresion inscription', ?)");
  $messageSupp->execute(array($_POST["suppInscription"], $messageAnnulation));
}
?>
<?php
  $requete = $bdd->prepare("SELECT * FROM planning WHERE id = ?");
  $requete->execute(array($idPlanning));
  $event = $requete ->fetch();

  $reqJeu = $bdd->prepare("SELECT * FROM jeux WHERE id = ?");
  $reqJeu->execute(array($event['id_jeux']));
  $jeu = $reqJeu ->fetch();

  $reqInscrit = $bdd->prepare("SELECT * FROM inscription WHERE id_planning= ? ");
  $reqInscrit->execute(array($event["id"]));
  $countInscrit = $reqInscrit->rowCount();
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
        <h6 class="card-text">Date et Heure de l'évènement : <?= $event["dateDebut"]?></h6>
        <h6 class="card-text"> Niveau :  <?= $event["niveau"]?></h6>
        <h6 class="card-text">Place :  <?= $countInscrit ?> /  <?= $event["places"]?></h6><br>
        <p class="card-text">Description du jeu : <br> <?= $jeu["description"]?></p>
        <p class="card-text"><a  href="document/regle/<?= $jeu["nom"]; ?>.pdf" >Règle du jeu</a></p>

      </div>
    </div>
  </div>
</div>


<table id="planning" align="center" class="table table-striped">
    <thead>
        <tr>
          <th colspan="4">Liste des inscrit</th>
        </tr>
      </thead>
      <tr>
        <td align="center">Pseudo</td>
        <td align="center">Supprimer</td>
      </tr>
    
    <?php 
      
      while($inscrit = $reqInscrit -> fetch())
      { 
        $reqMembre = $bdd->prepare("SELECT * FROM users WHERE id= ? ");
        $reqMembre->execute(array($inscrit['id_users']));
        $membre = $reqMembre->fetch();
    ?>
    <tr>
    
        <td align="center">  <?= $membre['pseudo'] ?>  </td>
        <td align="center"> <form method="POST"> <button name="suppInscription" value="<?= $inscrit['id_users'] ?>" type="submit">Supprimer son inscription</button>  </form> </td>
        
    </tr>
      <?php }
    ?>
   


  </table>
</section>
<?php include("code/piedPage.html") ?>