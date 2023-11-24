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
if(isset($_POST["suppMessage"]))
{
  $eventExist= $bdd->prepare("SELECT * FROM message WHERE id= ? ");
  $eventExist->execute(array($_POST["suppMessage"]));
  $exist = $eventExist->rowCount();
  if($exist==1)
  {
    $suppMessage= $bdd->prepare("DELETE FROM message WHERE id_users=? AND id=?");
    $suppMessage->execute(array($_SESSION['id'],$_POST["suppMessage"]));
  }

}


 ?>
<h1 align="center"> PROFIL <?= $_SESSION['pseudo'] ?></h1>

<section>
	<h2 align="center">Messagerie</h2><br>
	<table id="planning" align="center" class="table table-striped" >
		<thead>
		    <tr>
		      <th colspan="5">Mon planning</th>
		    </tr>
	    </thead>
	    <tr>
	    	<td align="center">Objet</td>
	    	<td align="center">Date</td>
	    	<td align="center"> Suppresion</td>
	    </tr>
		
		<?php 
			$req = $bdd->prepare("SELECT * FROM message WHERE id_users = ? ");
			$req->execute(array($_SESSION["id"]));
			while($message = $req -> fetch())
			{ ?>
		<tr>

				<td align="center">  <?= $message['objet'] ?>  </td>
				<td >  <?= $message['message'] ?>  </td>
				<td align="center"><form method="POST"> <button value="<?= $message['id'] ?>" name="suppMessage"type="submit">Supprimer</button>  </form> </td>
	
		<?php	}?>
		</tr>


	</table>
</section>

<section>
	<h2 align="center">Les plannings</h2><br>
	<table id="planning" align="center" class="table table-striped" >
		<thead>
		    <tr>
		      <th colspan="5">Mon planning</th>
		    </tr>
	    </thead>
	    <tr>
	    	<td align="center">Jeux</td>
	    	<td align="center">Date</td>
	    	<td align="center" >Temps</td>
	    	<td align="center">Niveau</td>
	    	<td align="center">Inscription</td>
	    </tr>
		
		<?php 
			$reqPlanning = $bdd->prepare("SELECT * FROM inscription WHERE id_users = ? ");
			$reqPlanning->execute(array($_SESSION["id"]));
			while($inscription = $reqPlanning -> fetch())
			{ ?>
		<tr>
		<?php  		

			$reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id = ? AND dateDebut > ?");
			$reqEvent->execute(array($inscription["id_planning"], $dateActuelle));
			while ($event = $reqEvent->fetch()) { 
				$reqJeu = $bdd -> prepare("SELECT * FROM jeux WHERE id = ?");
				$reqJeu->execute(array($event["id_jeux"]));
				$jeu = $reqJeu->fetch();

		?>
				<td align="center">  <?= $jeu['nom'] ?>  </td>
				<td align="center">  <?= $event['dateDebut'] ?>  </td>
				<td align="center">  <?= $event['duree'] ?> heures </td>
				<td align="center">  <?= $event['niveau'] ?>  </td>
				<td align="center"><form method="POST"> <button value="<?= $event['id'] ?>" name="desinscription"type="submit">Se désinscrire </button>  </form> </td>
			<?php }
		}?>
		</tr>


	</table>

	<table id="planning" align="center" class="table table-striped">
		<thead>
		    <tr>
		      <th colspan="4">Mon Historique</th>
		    </tr>
	    </thead>
	    <tr>
	    	<td align="center">Jeux</td>
	    	<td align="center">Date</td>
	    	<td align="center" >Temps</td>
	    	<td align="center">Niveau</td>
	    	

	    </tr>
		
		<?php 
			$reqPlanning = $bdd->prepare("SELECT * FROM inscription WHERE id_users = ? ");
			$reqPlanning->execute(array($_SESSION["id"] ));
			while($inscription = $reqPlanning -> fetch())
			{ ?>
		<tr>
		<?php  		

			$reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id = ? AND dateDebut < ?");
			$reqEvent->execute(array($inscription["id_planning"], $dateActuelle));
			while ($event = $reqEvent->fetch()) { 
				$reqJeu = $bdd -> prepare("SELECT * FROM jeux WHERE id = ?");
				$reqJeu->execute(array($event["id_jeux"]));
				$jeu = $reqJeu->fetch();

		?>
				<td align="center">  <?= $jeu['nom'] ?>  </td>
				<td align="center">  <?= $event['dateDebut'] ?>  </td>
				<td align="center">  <?= $event['duree'] ?> heures </td>
				<td align="center">  <?= $event['niveau'] ?>  </td>

			<?php }
		}?>
		</tr>


	</table>

</section>

<?php include("code/piedPage.html") ?>