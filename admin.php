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
	if(isset($_FILES['image_jeux']) AND !empty($_FILES['image_jeux']['name']) 
		AND isset($_FILES['regle_jeux']) AND !empty($_FILES['regle_jeux']['name']) )
	{
		$nom_jeu = htmlspecialchars($_POST["nom_jeu"]);
		$cat_jeu = $_POST["nom_jeu"];
		if(!empty($cat_jeu) && !empty($nom_jeu))
		{
			echo "wouah";
		}
	}
}




?>







<section id="ajoutJeu">
	<div><label>Nom</label><input type="text" id="nom_jeu" name=""> </div>
	<div><label>Description</label><input type="text" name=""> </div>
	<div><label>Catégorie</label>
			<select id="cat_select">
				<option>Coopératif</option>
				<option>Seul</option>
			</select>
	</div>
	<div><label>Règle de jeu</label><input type="file" id="regle" id=""  name=""> </div>
	<div><label>Image</label><input type="file" id="image_jeux" name="image jeux"> </div>
	<div><label>Ajouter</label><input id="ajoutJeu" type="submit" id="subAjoutJeu" name=""> </div>
</section>


<section id="ajoutAdmin">
	<div><label>Pseudo du nouvel admin</label><input type="text" id="" name=""> </div>
	<div><label>Votre mot de passe</label><input type="password" name=""> </div>
	<div><label>Ajouter</label><input id="subAjoutAdmin" type="submit" name=""> </div>

</section>



<?php include("code/PiedPage.html") ?>
