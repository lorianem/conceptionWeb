<?php include("connection_BDD.php") ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LUKIDO</title>
	<link rel="stylesheet" href="code/style.css">
	<link rel="shortcut icon" href="image/logo.png">
</head>
<body>
	<nav>
		<img src="image/logo.png">

		<a href="index.php"> Home </a>


		<?php
			if(isset($_SESSION) && !empty($_SESSION))
			{
				if(($_SESSION['role'] == "0"))	
				{
					?>
						<a href="jeux.php"> jeux </a>
						<a href="planning.php"> planning </a>
						<div class="profil">
							<a href="profil.php">Profil</a> / 
							<a href="code/deconnection.php">deconnection</a>
						</div>
							
					<?php  
				}
				elseif($_SESSION['role'] == "1")
				{
					?>
						<a href="jeux.php"> jeux </a>
						<a href="planning.php"> planning </a>
						<a href="admin.php"> admin </a>
						<div class="profil">
							<a href="profil.php">Profil</a> / 
							<a href="code/deconnection.php">deconnection</a>
						</div>
						
					<?php 
				}
				

			}
			else
			{
				?>
				<div class="profil">
					<a href="connection.php"> Connection </a> / 
					<a href="inscription.php"> Inscription </a>
				</div>
				
				<?php  
			}
		?>
	</nav>

