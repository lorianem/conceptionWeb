<?php include("connection_BDD.php") ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LUKIDO</title>
	<link rel="stylesheet" href="code/style.css">
	<link rel="shortcut icon" href="image/logo.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<nav>
		<img src="image/logo.png">

		<a id="nav1" href="index.php"> Home </a>


		<?php
			if(isset($_SESSION) && !empty($_SESSION))
			{
				if(($_SESSION['role'] == "0"))	
				{
					?>
						<a id="nav2" href="jeux.php"> jeux </a>
						<a id="nav3" href="planning.php"> planning </a>
						<div class="profil">
							<a id="nav5" href="profil.php">Profil</a> 
							<a id="nav6" href="code/deconnection.php">deconnection</a>
						</div>
							
					<?php  
				}
				elseif($_SESSION['role'] == "1")
				{
					?>
						<a id="nav2" href="jeux.php"> jeux </a>
						<a id="nav3" href="planning.php"> planning </a>
						<a id="nav4" href="admin.php"> admin </a>
						<div class="profil">
							<a id="nav5"  href="profil.php">Profil</a> 
							<a id="nav6"  href="code/deconnection.php">deconnection</a>
						</div>
						
					<?php 
				}
				

			}
			else
			{
				?>
				<div class="profil">
					<a id="nav5" href="connection.php"> Connection </a> 
					<a id="nav6" href="inscription.php"> Inscription </a>
				</div>
				
				<?php  
			}
		?>
	</nav>

