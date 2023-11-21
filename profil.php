<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>





<section>
	<h1> PROFIL </h1>

<section>
	<h2>Planning</h2>
	<table id="planning" align="center" >
		<thead>
	    <tr>
	      <th colspan="5">Mon planning</th>
	    </tr>
	    <tr>
	    	<td align="center">Jeux</td>
	    	<td align="center">Date</td>
	    	<td align="center" >Temps (H)</td>
	    	<td align="center">Niveau</td>
	    	<td align="center">Inscription</td>
	    </tr>
		
		<?php 
			$reqPlanning = $bdd->prepare("SELECT * FROM inscription WHERE id_users = ?");
			$reqPlanning->execute(array($_SESSION["id"]));
			while($inscription = $reqPlanning -> fetch())
			{ ?>
		<tr>
		<?php  		

			$reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id = ?");
			$reqEvent->execute(array($inscription["id_planning"]));
			while ($event = $reqEvent->fetch()) { 
				$reqJeu = $bdd -> prepare("SELECT * FROM jeux WHERE id = ?");
				$reqJeu->execute(array($event["id_jeux"]));
				$jeu = $reqJeu->fetch();
				echo $event["id_jeux"]
		?>
				<td align="center">  <?= $jeu['nom'] ?>  </td>
				<td align="center">  <?= $event['dateDebut'] ?>  </td>
				<td align="center">  <?= $event['duree'] ?>  </td>
				<td align="center">  <?= $event['niveau'] ?>  </td>
				<td align="center">  desinscription  </td>
			<?php }
		}?>
		</tr>


	</table>
</section>
<section>
	<h2>Historique des évènements</h2>
	<table id="planning" align="center" >
		<thead>
	    <tr>
	      <th colspan="5">Mon planning</th>
	    </tr>
	    <tr>
	    	<td align="center">Jeux</td>
	    	<td align="center">Date</td>
	    	<td align="center" >Temps (H)</td>
	    	<td align="center">Niveau</td>
	    	<td align="center">Inscription</td>
	    </tr>
		
		<?php 
			$reqPlanning = $bdd->prepare("SELECT * FROM inscription WHERE id_users = ?");
			$reqPlanning->execute(array($_SESSION["id"]));
			while($inscription = $reqPlanning -> fetch())
			{ ?>
		<tr>
		<?php  		

			$reqEvent = $bdd -> prepare("SELECT * FROM planning WHERE id = ?");
			$reqEvent->execute(array($inscription["id_planning"]));
			while ($event = $reqEvent->fetch()) { 
				$reqJeu = $bdd -> prepare("SELECT * FROM jeux WHERE id = ?");
				$reqJeu->execute(array($event["id_jeux"]));
				$jeu = $reqJeu->fetch();
				echo $event["id_jeux"]
		?>
				<td align="center">  <?= $jeu['nom'] ?>  </td>
				<td align="center">  <?= $event['dateDebut'] ?>  </td>
				<td align="center">  <?= $event['duree'] ?>  </td>
				<td align="center">  <?= $event['niveau'] ?>  </td>
				<td align="center">  desinscription  </td>
			<?php }
		}?>
		</tr>


	</table>
</section>
</section>