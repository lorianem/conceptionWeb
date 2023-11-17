<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>
<?php 

	if($_SESSION["role"]!= 1)
	{
		header("Location: index.php");
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
				$requete = $bdd -> prepare("INSERT INTO jeux(nom, description, id_categorie) VALUES(?, ?, ?)");
				$requete -> execute(array($nom_jeu,$description_jeu,$cat_jeu));
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
				}
			}	

		}
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
		}
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
		echo "1";
		$requete = $bdd -> prepare("INSERT INTO planning(id_jeux, places, dateDebut, niveau, duree) VALUES (?,?,?,?,?)");
		$requete -> execute(array($idJeu, $nbPlace, $date, $duree, $nbPlace));
	}
}
?>

<?php 

if (isset($_POST['subAjoutAdmin'])) 
{
	echo "1";
	$pseudoAjoutAdmin = htmlspecialchars($_POST["pseudoAjoutAdmin"]);
	if (!empty($pseudoAjoutAdmin)) {
		echo "1";
		$reqAdmin= $bdd->prepare("SELECT * FROM users WHERE pseudo = ?"); 
		$reqAdmin->execute(array($pseudoAjoutAdmin));
		$userExist = $reqAdmin->rowCount();
		if($userExist == 1) 
		{
			echo "1";
			$requete = $bdd -> prepare("UPDATE users SET role=1 WHERE pseudo=?");
			$requete -> execute(array($pseudoAjoutAdmin));
		}
	}
}
?>

<?php 

if (isset($_POST['subSuppEvent'])) 
{
	$idEvent = $_POST["eventSelect"];
	if(!empty($idEvent))
	{

		$requete = $bdd -> prepare("DELETE FROM planning WHERE id = ?");
		$requete -> execute(array($idEvent));
	}
	
}

?>


<section id="ajoutJeu">
	<h2>Ajout d'un nouveau jeu</h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Nom : </label><input type="text" id="nom_jeu" name="nom_jeu"> </div>
		<div><label>Description : </label><input type="text" name="description"> </div>
		<div><label>Catégorie : </label>
				<select id="cat_select" name="cat_select">
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
		<div><label>Règle de jeu : </label><input type="file" name="regle_jeu"> </div>
		<div><label>Image : </label><input type="file" name="image_jeu"> </div><br>
		<div><label>Ajouter : </label><input id="subAjoutJeu" type="submit" name="subAjoutJeu"> </div>
	</form>		
</section><br>



<section id="ajoutCategorie">
	<h2>Ajout d'une catégorie de jeu </h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Nom catégorie</label><input type="text" id="" name="nom_categorie"> </div><br>
		<div><label>Ajouter : </label><input id="subAjoutCategorie" value="Ajouter" type="submit" name="subAjoutCategorie"> </div>
	</form>
</section><br>



<section id="ajoutEvent">
	<h2>Ajout d'un évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Jeu : </label>

				<select id="jeuSelect" name="jeuSelect">
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
		<div>
			<label>Difficulté : </label>
			<select id="difSelect" name="difSelect">
				<option value="Tous">Tous</option>
				<option value="Neophyte">Néophyte</option>
				<option value="Debutant">Débutant</option>
				<option value="Intermediaire">Intermediaire</option>
				<option value="Expert" >Expert</option>
				<option value="Maitre">Maitre</option>
			</select>
		</div>
		<div><label>Date évènement : </label><input name="dateEvent" type="date" > </div>
		<div><label>Temps de jeu : </label><input type="number" name="dureeEvent"> </div>
		<div><label>Nombre de place : </label><input type="number" name="nbPlace"> </div><br>
		<div><label>Ajouter : </label><input id="subAjoutEvent" value="Ajouter" type="submit" name="subAjoutEvent"> </div>
	</form>
</section><br>


<section id="suppressionEvent">
	<h2>Suppression évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Catégorie : </label>
				<select id="eventSelect" name="eventSelect">
					<?php 
						$requetes = $bdd->prepare("SELECT * FROM planning"); 
					    $requetes->execute();
						while($resultat =  $requetes->fetch())
						{
							$reqJeu = $bdd->prepare("SELECT * FROM jeux"); 
					    	$reqJeu->execute(array($resultat['id']));
					   		 $resulJeu =  $reqJeu->fetch();
							?>

							<option value="<?= $resultat['id'] ?>" >   <?= $resulJeu['nom'] ?>, date :   <?= $resultat['dateDebut'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		<div><label>Supprimer : </label><input id="subSuppEvent" value="Supprimer" type="submit" name="subSuppEvent"> </div>
	</form>
</section><br>


<section id="ajoutAdmin">
	<form method="POST" enctype="multipart/form-data">
		<h2>Ajout d'un administrateur</h2>
		<div><label>Pseudo du nouvel admin : </label><input type="text" id="pseudoAjoutAdmin" name="pseudoAjoutAdmin"> </div>
		<div><label>Ajouter : </label><input id="subAjoutAdmin" value="Ajouter" type="submit" name="subAjoutAdmin"> </div>
	</form>
</section>



<?php include("code/PiedPage.html") ?>
