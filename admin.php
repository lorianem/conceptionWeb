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

} ?>

<?php 
if (isset($_POST['subAjoutEvent']))
{

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
							<option value="<?= $resultat['id'] ?>" ><?= $resultat['categorie'] ?></option>
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
		<div><label>Ajouter : </label><input id="subAjoutCategorie" type="submit" name="subAjoutCategorie"> </div>
	</form>
</section><br>



<section id="ajoutEvent">
	<h2>Ajout d'un évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Jeu : </label>

				<select id="cat_select" name="cat_select">
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
		<div><label>Date évènement : </label><input name="date_event" type="date" > </div><br>
		<div><label>Ajouter : </label><input id="subAjoutEvent" type="submit" name="subAjoutEvent"> </div>
	</form>
</section><br>


<section id="suppressionEvent">
	<h2>Suppression évènement </h2>
	<form method="POST" enctype="multipart/form-data">
		<div><label>Catégorie : </label>
				<select id="cat_select" name="cat_select">
					<?php 
						$requetes = $bdd->prepare("SELECT * FROM planning"); 
					    $requetes->execute();
						while($resultat =  $requetes->fetch())
						{
							$reqJeu = $bdd->prepare("SELECT * FROM jeux"); 
					    	$reqJeu->execute(array($resultat['id']));
					   		 $resulJeu =  $reqJeu->fetch();
							?>

							<option value="<?= $resultat['id'] ?>" >   Jeu : <?= $$resulJeu['nom'] ?> date :   <?= $resultat['creneau'] ?> </option>
						<?php  }
					?>
				</select>
		</div>
		<div><label>Ajouter</label><input id="subAjoutCategorie" type="submit" name="subAjoutCategorie"> </div>
	</form>
</section><br>


<section id="ajoutAdmin">
	<h2>Ajout d'un administrateur</h2>
	<div><label>Pseudo du nouvel admin</label><input type="text" id="" name=""> </div>
	<div><label>Votre mot de passe</label><input type="password" name=""> </div>
	<div><label>Ajouter</label><input id="subAjoutAdmin" type="submit" name="subAjoutAdmin"> </div>

</section>



<?php include("code/PiedPage.html") ?>
