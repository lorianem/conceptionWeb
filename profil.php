<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php  $dateActuelle = date("Y-m-d H:i:s");?>


<h1 align="center"> PROFIL </h1>

<section>
	<h2 align="center">Les plannings</h2><br>
	<table id="planning" align="center" class="table table-striped" >
		<thead>
	    <tr>
	      <th colspan="5">Mon planning</th>
	    </tr>
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
				<td align="center">  desinscription  </td>
			<?php }
		}?>
		</tr>


	</table>

	<table id="planning" align="center" class="table table-striped">
		<thead>
	    <tr>
	      <th colspan="5">Mon Historique</th>
	    </tr>
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
</section>