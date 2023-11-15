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
	echo "ok";
	if(isset($_FILES['image_jeux']) AND !empty($_FILES['image_jeux']['name']) 
		AND isset($_FILES['regle_jeux']) AND !empty($_FILES['regle_jeux']['name']) )
	{
		echo "ok";
		$nom_jeu = htmlspecialchars($_POST["nom_jeu"]);
		$cat_jeu = $_POST["nom_jeu"];
		if(!empty($cat_jeu) && !empty($nom_jeu))
		{
			echo "ok";
			$extension_image = array('jpg', 'jpeg', 'png');
			$extension_regle = array('pdf');

			$extensionImageUpload = strtolower(substr(strrchr($_FILES['image_jeux']['name'], '.'), 1));
			$extensionRegleUpload = strtolower(substr(strrchr($_FILES['regle_jeux']['name'], '.'), 1));

			if(in_array($extensionImageUpload, $extension_image) && in_array($extensionRegleUpload, $extension_regle))
			{
				echo "ok";
				$cheminImage = "image/jeu/"".".$nom_jeu.$extensionImageUpload;
                $resultat = move_uploaded_file($_FILES['image_jeux']['tmp_name'], $cheminImage);

                $cheminRegle = "document/regle/"".".$nom_jeu.$extensionImageUpload;
                $resultat = move_uploaded_file($_FILES['regle_jeux']['tmp_name'], $cheminRegle);
			}

		}
	}
}




?>







<section id="ajoutJeu">
	<div><label>Nom : </label><input type="text" id="nom_jeu" name=""> </div>
	<div><label>Description : </label><input type="text" name=""> </div>
	<div><label>Catégorie : </label>
			<select id="cat_select">
				<?php 
					$requetes = $bdd->prepare("SELECT * FROM categorie"); 
				    $requetes->execute();
					while($resultat =  $requetes->fetch())
					{?>
						<option label="<?= $resultat['categorie'] ?>" >1<?= $resultat['categorie'] ?></option>
					<?php  }
				?>
			</select>
	</div>
	<div><label>Règle de jeu : </label><input type="file" id="regle" id=""  name=""> </div>
	<div><label>Image : </label><input type="file" id="image_jeux" name="image jeux"> </div><br>
	<div><label>Ajouter : </label><input id="ajoutJeu" type="submit" id="subAjoutJeu" name=""> </div>
</section><br><br><br>Q

<section id="ajoutAdmin">
	<div><label>Pseudo du nouvel admin</label><input type="text" id="" name=""> </div>
	<div><label>Votre mot de passe</label><input type="password" name=""> </div>
	<div><label>Ajouter</label><input id="subAjoutAdmin" type="submit" name=""> </div>

</section>



<?php include("code/PiedPage.html") ?>
