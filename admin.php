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
		if(!empty($cat_jeu) && !empty($nom_jeu))
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
					$cheminImage = "image/jeux/".$nom_jeu.$extensionImageUpload;
	                $resultat = move_uploaded_file($_FILES['image_jeu']['tmp_name'], $cheminImage);

	                $cheminRegle = "document/regle/".$nom_jeu.$extensionImageUpload;
	                $resultat = move_uploaded_file($_FILES['regle_jeu']['tmp_name'], $cheminRegle);
				}
			}


				

		}
	}

}




?>

<section id="ajoutJeu">
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
		
</section><br><br><br>Q

<section id="ajoutAdmin">
	<div><label>Pseudo du nouvel admin</label><input type="text" id="" name=""> </div>
	<div><label>Votre mot de passe</label><input type="password" name=""> </div>
	<div><label>Ajouter</label><input id="subAjoutAdmin" type="submit" name="subAjoutAdmin"> </div>
</section>


<section id="ajoutAdmin">
	<div><label>Pseudo du nouvel admin</label><input type="text" id="" name=""> </div>
	<div><label>Votre mot de passe</label><input type="password" name=""> </div>
	<div><label>Ajouter</label><input id="subAjoutAdmin" type="submit" name="subAjoutAdmin"> </div>

</section>



<?php include("code/PiedPage.html") ?>
