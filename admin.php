<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php 

	if($_SESSION["role"]!= 1)
	{
		header("Location: index.php");
	}
?>

<?php 

if (isset($_POST['subSuppJeu'])) 
{
	$idJeu = $_POST["jeuSelectSupp"];
	if(!empty($idJeu))
	{
		$requete = $bdd -> prepare("DELETE FROM jeux WHERE id = ?");
		$requete -> execute(array($idJeu));
		$msgSuppJeu = "Jeu supprimé";
		
	}
	else
	{
		$msgSuppJeu = "Renseignez le jeu";
	}
}

?>
<?php 
if (isset($_POST['subAjoutJeu']))
{

	if(isset($_FILES['image_jeu']) AND !empty($_FILES['image_jeu']['name']) 
		AND isset($_FILES['regle_jeu']) AND !empty($_FILES['regle_jeu']['name']) )
	{
		$nom_jeu = ucfirst(htmlspecialchars($_POST["nom_jeu"]));
		$description_jeu = htmlspecialchars($_POST["description"]);
		$cat_jeu = $_POST["cat_select"];
		
	
		if(!empty($cat_jeu) && !empty($nom_jeu) && !empty($description_jeu))
		{

			$reqjeu = $bdd->prepare("SELECT * FROM jeux WHERE nom = ?"); 
			$reqjeu->execute(array($nom_jeu));
			$jeuExist = $reqjeu->rowCount(); 

			if($jeuExist == 0)
			{
				
				$extension_image = array('jpg', 'jpeg', 'png');
				$extension_regle = array('pdf');

				$extensionImageUpload = strtolower(substr(strrchr($_FILES['image_jeu']['name'], '.'), 1));
				$extensionRegleUpload = strtolower(substr(strrchr($_FILES['regle_jeu']['name'], '.'), 1));

				if(in_array($extensionImageUpload, $extension_image) && in_array($extensionRegleUpload, $extension_regle))
				{
					$cheminImage = "image/jeux/".$nom_jeu.".".$extensionImageUpload;
	                $resultat = move_uploaded_file($_FILES['image_jeu']['tmp_name'], $cheminImage);

	                $cheminRegle = "document/regle/".$nom_jeu.".".$extensionRegleUpload;
	                $resultat = move_uploaded_file($_FILES['regle_jeu']['tmp_name'], $cheminRegle);

	                $requete = $bdd -> prepare("INSERT INTO jeux(nom, description, id_categorie, image) VALUES(?, ?, ?, ?)");
					$requete -> execute(array($nom_jeu,$description_jeu,$cat_jeu, $nom_jeu.".".$extensionImageUpload));

	                $msgAjoutJeu = "Jeu ajouté";
				}
				else
				{
					$msgAjoutJeu = "Respectez les bon format pour les fichier, pdf pour les règles";
				}
			}
			else 
			{
				$msgAjoutJeu = "Ce jeu existe déjà";
			}	

		}
		else
		{
			$msgAjoutJeu = "Veillez remplir tout les champs";
		}
	}
	else
		{
			$msgAjoutJeu = "Veillez joindre les fichiers";
		}
} 
?>




<?php 
if (isset($_POST['subAjoutCategorie']))
{
	$nom_categorie = ucfirst(htmlspecialchars($_POST["nom_categorie"]));
	if (!empty($nom_categorie)) {
		$reqcat = $bdd->prepare("SELECT * FROM categorie WHERE nom = ?"); 
		$reqcat->execute(array($nom_categorie));
		$catExist = $reqcat->rowCount(); 
		if($catExist == 0)
		{
			$requete = $bdd -> prepare("INSERT INTO categorie(nom) VALUES(?)");
			$requete -> execute(array($nom_categorie));
			$msgAjoutCat = "Catégorie ajouté";
		}
		else
		{
			$msgAjoutJeu = "Catégorie déjà existante";
		}
	}
	else
	{
		$msgAjoutCat = "Veillez remplir tout les champs";
	}
}
?>


<?php 
if (isset($_POST['subAjoutEvent']))
{

	$idJeu = ucfirst(htmlspecialchars($_POST["jeuSelect"]));
	$difficulte = htmlspecialchars($_POST["difSelect"]);
	$date = $_POST["dateEvent"];
	$duree = $_POST["dureeEvent"];
	$nbPlace = $_POST["nbPlace"];


	if ( !empty($idJeu) && !empty($difficulte) && !empty($date) &&  !empty($duree) && !empty($nbPlace) )

	{    
		$requete = $bdd -> prepare("INSERT INTO planning(id_jeux, places, dateDebut, niveau, duree) VALUES (?,?,?,?,?)");
		$requete -> execute(array($idJeu, $nbPlace, $date,$difficulte, $duree));
		$msgAjoutEvent = "Évènement ajouté";
	}
	else
	{
		$msgAjoutEvent = "Veillez remplir tout les champs";
	}
}
?>






<?php 

if (isset($_POST['subSuppEvent'])) 
{
	$idEvent = $_POST["eventSelect"];
	if(!empty($idEvent))
	{
		$reqMes= $bdd->prepare("SELECT * FROM inscription WHERE id_planning = ?");
		$reqMes->execute(array($idEvent));
		while($resultMess = $reqMes -> fetch())
		{
			$messageAnnulation = "Bonjour <br> Nous sommes désolé de vous annoncer que la séance de jeux auquel vous étiez inscrit vient d'être annuler. <br>  Vous nous prions de nous excuser <br> <br> Cordialement toutes l'équipe";
			$messageSupp = $bdd->prepare("INSERT INTO message(id_users, objet, message) VALUES (?, 'Annulation evenement', ?)");
			$messageSupp->execute(array($resultMess["id_users"], $messageAnnulation));
		}
		$requete = $bdd -> prepare("DELETE FROM planning WHERE id = ?"); // Table en delete cascade donc les lignes dans inscription sont aussi supprimée
		$requete -> execute(array($idEvent));
		$msgSuppEvent = "Evènement supprimé";
	}
	else
	{
		$msgSuppEvent = "Veillez remplir tout les champs";
	}
	
}

?>



<?php

	if (isset($_POST['subModifJeu'])) 
	{
		$idMod = $_POST["modJeuSelect"];
		if(isset($_POST["modDescription"]) && !empty($_POST["modDescription"]))
		{
			$description = htmlspecialchars($_POST["modDescription"]);
			$req = $bdd->prepare("UPDATE jeux SET description = ? WHERE id = ?"); 
			$req->execute(array($description,$idMod));
		}
		if(isset($_FILES['modRegle_jeu']) AND !empty($_FILES['modRegle_jeu']['name']))
		{
			$extension_regle = array('pdf');
			$extensionRegleUpload = strtolower(substr(strrchr($_FILES['modRegle_jeu']['name'], '.'), 1));
			if(in_array($extensionRegleUpload,$extension_regle))
			{
				$req = $bdd->prepare("SELECT * FROM jeux WHERE id = ?"); 
				$req->execute(array($idMod));
				$jeu = $req->fetch();

				$cheminRegle = "document/regle/".$jeu["nom"].".".$extensionRegleUpload;
	            $resultat = move_uploaded_file($_FILES['modRegle_jeu']['tmp_name'], $cheminRegle);
			}

		}
		if(isset($_FILES['modImage_jeu']) AND !empty($_FILES['modImage_jeu']['name']))
		{
			$extension_image = array('jpg', 'jpeg', 'png');
			$extensionImageUpload = strtolower(substr(strrchr($_FILES['modImage_jeu']['name'], '.'), 1));
			

			if(in_array($extensionImageUpload, $extension_image))
			{
				$req = $bdd->prepare("SELECT * FROM jeux WHERE id = ?"); 
				$req->execute(array($idMod));
				$jeu = $req->fetch();
				
				$cheminImage = "image/jeux/".$jeu["nom"].".".$extensionImageUpload;
	            $resultat = move_uploaded_file($_FILES['modImage_jeu']['tmp_name'], $cheminImage);
			}

		}
		if(isset($_POST["modNom"]) && !empty($_POST["modNom"]))
		{
			$nom = ucfirst(htmlspecialchars($_POST["modNom"]));

			$req = $bdd->prepare("SELECT * FROM jeux WHERE id = ?"); 
			$req->execute(array($idMod));
			$jeu = $req->fetch();
			$extension = strtolower(substr(strrchr($jeu["image"], '.'), 1));
			rename("image/jeux/" . $jeu["image"] , "image/jeux/" . $nom . "." . $extension);
			rename("document/regle/".$jeu["nom"].".pdf", "document/regle/".$nom.".pdf");

			$upd = $bdd->prepare("UPDATE jeux SET nom = ?, image = ? WHERE id = ?"); 
			$upd->execute(array($nom, $nom.".".$extension ,$idMod));
		}

	}

?>

<?php
	if(isset($_POST["subAffEvent"]))
	{
		if(isset($_POST["eventSelectAff"]) && !empty($_POST["eventSelectAff"]))
		{
			header("Location: event.php?id=" . $_POST["eventSelectAff"]);
			exit();  
		}
	}
?>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link" href="#ajoutJeu">Ajout jeu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#modifJeu">Modifier jeu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#ajoutCategorie">Ajout categorie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#ajoutEvent">Ajout event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#suppressionEvent">Suppression event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#suppressionJeu">Suppresion jeu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#AfficherEvent">Afficher event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#ajoutAdmin">Ajouter un admin</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<section id="ajoutJeu" >
	<h2>Ajout d'un nouveau jeu</h2><br>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3" ><label class="form-label">Nom : </label><input type="text" id="nom_jeu" name="nom_jeu" class="form-control"> </div>
		<div class="mb-3"><label class="form-label">Description : </label><input type="text" name="description" class="form-control"> </div>
		<div class="mb-3"><label class="form-label">Catégorie : </label>
				<select id="cat_select" name="cat_select" class="form-control">
					<?php 
						$requetes = $bdd->prepare("SELECT * FROM categorie"); 
					    $requetes->execute();
						while($resultat =  $requetes->fetch())
						{?>
							<option value="<?= $resultat['id'] ?>" ><?= $resultat['nom'] ?></option>
						<?php  }
					?>
				</select>
		</div>
		<div class="mb-3"><label class="form-label">Règle de jeu : </label><input type="file" name="regle_jeu" class="form-control"> </div>
		<div class="mb-3"> <label class="form-label">Image : </label><input type="file" name="image_jeu" class="form-control"> </div>
		<p class="error"><?php if(isset($msgAjoutJeu)) {  echo '<font color="red">'.$msgAjoutJeu."</font>"; } ?></p><br>

		<div class="mb-3"><input class="btn btn-primary" id="subAjoutJeu" type="submit" name="subAjoutJeu" value="Ajouter"> </div>
	</form>		
</section><br>


<section id="modifJeu" >
	<h2>Modification jeu</h2>
	<form method="POST" enctype="multipart/form-data">
	<div class="mb-3"><label class="form-label">Jeu : </label>
					<select class="form-control"  id="modJeuSelect" name="modJeuSelect">
						<?php 
							$requetes = $bdd->prepare("SELECT * FROM jeux"); 
						    $requetes->execute();
							while($resultat =  $requetes->fetch())
							{?>
								<option value="<?= $resultat['id'] ?>" ><?= $resultat['nom'] ?> </option>
							<?php  }
						?>
					</select>
			</div>

		<div class="mb-3">
			<label class="form-label">Modification nom : </label>
			<input class="form-control" type="text" name="modNom"> 
		</div>
		<div class="mb-3">
			<label class="form-label">Modification description : </label>
			<input class="form-control" type="text" name="modDescription"> 
		</div>
		<div class="mb-3">
			<label class="form-label">Modification des règles de jeu : </label>
			<input class="form-control" type="file" name="modRegle_jeu"> 
		</div>
		<div class="mb-3">
			<label class="form-label">Image : </label>
			<input class="form-control" type="file" name="modImage_jeu"> 
		</div>

		<p class="error"><?php if(isset($msgModifJeu)) {  echo '<font color="red">'.$msgModifJeu."</font>"; } ?></p><br>

		<div><input class="btn btn-primary" id="subModifJeu" type="submit" name="subModifJeu"> </div>
	</form>		
</section><br>

<section id="ajoutCategorie" > 
	<h2>Ajout d'une catégorie de jeu </h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3">
			<label class="form-label">Nom catégorie : </label >
			<input class="form-control" type="text" id="" name="nom_categorie">
		</div>
		<p class="error"><?php if(isset($msgAjoutCat)) {  echo '<font color="red">'.$msgAjoutCat."</font>"; } ?></p><br>
		<div class="mb-3"><input class="btn btn-primary" id="subAjoutCategorie" value="Ajouter" type="submit" name="subAjoutCategorie"> </div>

	</form>
</section><br>



<section id="ajoutEvent" >
	<h2>Ajout d'un évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3"><label class="form-label">Jeu : </label>

				<select class="form-control" id="jeuSelect" name="jeuSelect">
					<?php 
						$requetes = $bdd->prepare("SELECT * FROM jeux"); 
					    $requetes->execute();
						while($resultat =  $requetes->fetch())
						{?>
							<option value="<?= $resultat['id'] ?>" ><?= $resultat['nom'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		<div class="mb-3">
			<label class="form-label">Difficulté : </label>
			<select class="form-control" id="difSelect" name="difSelect">
				<option value="Tous">Tous</option>
				<option value="Neophyte">Néophyte</option>
				<option value="Debutant">Débutant</option>
				<option value="Intermediaire">Intermediaire</option>
				<option value="Expert" >Expert</option>
				<option value="Maitre">Maitre</option>
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label">Date évènement : </label>
			<input name="dateEvent" class="form-control" type="datetime-local" > 
		</div>
		<div class="mb-3">
			<label class="form-label">Temps de jeu : </label>
			<input type="number" name="dureeEvent" class="form-control"> 
		</div>
		<div class="mb-3">
			<label class="form-label">Nombre de place : </label>
			<input type="number" name="nbPlace" class="form-control">
		</div>
		<p class="error">
			<?php if(isset($msgAjoutEvent)) {  echo '<font color="red">'.$msgAjoutEvent."</font>"; } ?>
		</p><br>
		<div class="mb-3"><input class="btn btn-primary" id="subAjoutEvent" value="Ajouter" type="submit" name="subAjoutEvent"> </div>
	</form>
</section><br>


<section id="suppressionEvent" >
	<h2>Suppression évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3"> <label class="form-label">Catégorie : </label>
				<select class="form-control" id="eventSelect" name="eventSelect">
					<?php 
						$dateActuelle = date("Y-m-d H:i:s");
						$requetes = $bdd->prepare("SELECT * FROM planning WHERE dateDebut > ?"); 
					    $requetes->execute(array($dateActuelle));
						while($resultat =  $requetes->fetch())
						{
							$reqJeu = $bdd->prepare("SELECT * FROM jeux WHERE id=?"); 
					    	$reqJeu->execute(array($resultat['id_jeux']));
					   		$resulJeu =  $reqJeu->fetch();
							?>

							<option value="<?= $resultat['id'] ?>" >   <?= $resulJeu['nom'] ?>, date :   <?= $resultat['dateDebut'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		<p class="error"><?php if(isset($msgSuppEvent)) { echo '<font color="red">'.$msgSuppEvent."</font>";  } ?></p><br>

		<div class="mb-3"><input class="btn btn-primary" id="subSuppEvent" value="Supprimer" type="submit" name="subSuppEvent"> </div>
	</form>
</section><br>




<section id="suppressionJeu" >
	<h2>Suppression Jeu </h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3"> <label class="form-label">Catégorie : </label>
				<select class="form-control" id="jeuSelectSupp" name="jeuSelectSupp">
					<?php 
						$requetes = $bdd->prepare("SELECT * FROM jeux"); 
					    $requetes->execute();
						while($resultat =  $requetes->fetch())
						{?>
							<option value="<?= $resultat['id'] ?>" ><?= $resultat['nom'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		<p class="error"><?php if(isset($msgSuppJeu)) { echo '<font color="red">'.$msgSuppJeu."</font>";  } ?></p><br>

		<div class="mb-3"><input class="btn btn-primary" id="subSuppJeu" value="Supprimer" type="submit" name="subSuppJeu"> </div>
	</form>
</section><br>

<section id="AfficherEvent" >
	<h2>Afficher la fiche évènement</h2>
	<form method="POST" enctype="multipart/form-data">
		<div class="mb-3"> <label class="form-label">Catégorie : </label>
				<select class="form-control" id="eventSelectAff" name="eventSelectAff">
					<?php 
						$dateActuelle = date("Y-m-d H:i:s");
						$requetes = $bdd->prepare("SELECT * FROM planning WHERE dateDebut > ?"); 
					    $requetes->execute(array($dateActuelle));
						while($resultat =  $requetes->fetch())
						{
							$reqJeu = $bdd->prepare("SELECT * FROM jeux WHERE id=?"); 
					    	$reqJeu->execute(array($resultat['id_jeux']));
					   		$resulJeu =  $reqJeu->fetch();
							?>

							<option value="<?= $resultat['id'] ?>" >   <?= $resulJeu['nom'] ?>, date :   <?= $resultat['dateDebut'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		
		<div class="mb-3"><input class="btn btn-primary" id="subAffEvent" value="Afficher" type="submit" name="subAffEvent"> </div>
	</form>
</section><br>


<section id="ajoutAdmin" >
	<form method="POST" enctype="multipart/form-data">
		<h2>Ajout d'un administrateur</h2>
		<div class="mb-3">
			<label class="form-label">Pseudo du nouvel admin : </label>
			<input class="form-control"type="text" id="pseudoAjoutAdmin" name="pseudoAjoutAdmin">
		</div>
		<p class="error"><?php if(isset($msgAjoutAdmin)) {  echo '<font color="red">'.$msgAjoutAdmin."</font>"; } ?></p><br>
		<div class="mb-3"> <input class="btn btn-primary" id="subAjoutAdmin" value="Ajouter" type="submit" name="subAjoutAdmin"> </div>
		
	</form>
</section>



<?php include("code/piedPage.html") ?>
