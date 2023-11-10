<?php include("code/EnTete.php") ?>
<<?php 
	
	
 ?>

<section id="ajoutJeu">
	<div><label>Nom</label><input type="text" name=""> </div>
	<div><label>Description</label><input type="text" name=""> </div>
	<div><label>Catégorie</label>
			<select id="cat_select">
				<option>Coopératif</option>
				<option>Seul</option>
			</select>
	</div>
	<div><label>Règle de jeu</label><input type="file" id="regle" name=""> </div>
	<div><label>Image</label><input type="file" id="image_jeux" name=""> </div>
	<div><label>Ajouter</label><input type="submit" name=""> </div>
</section>




<?php include("code/PiedPage.html") ?>
