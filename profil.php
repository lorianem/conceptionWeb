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

<h1 align="center"> PROFIL </h1>



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
	    	<td align="center" >Temps (H)</td>
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