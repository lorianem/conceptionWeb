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
	



	<nav class="navbar navbar-dark bg-dark fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">LUKIDO</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
				<span class="navbar-toggler-icon"></span>
	    	</button>

	    	<div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
	    		<div class="offcanvas-header">
						<h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu de navigation</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
			<div class="offcanvas-body">
			<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          		<li class="nav-item">
					<a class="nav-link" id="nav1"  href="index.php"> Home </a>
				</li>
				<?php
					if(isset($_SESSION) && !empty($_SESSION))
					{
						if(($_SESSION['role'] == "0"))	
						{
							?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Jeux
									</a>
									<ul class="dropdown-menu dropdown-menu-dark">
										<li><a class="dropdown-item" href="jeux2.php">Tous les jeux</a></li>
										<li><a class="dropdown-item" href="favoris.php">Mes favoris</a></li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav3" href="planning.php"> Planning </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav5" href="profil.php">Profil</a> 
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav6" href="code/deconnection.php">Déconnection</a>
								</li>
									
							<?php  
						}
						elseif($_SESSION['role'] == "1")
						{
							?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="jeux2.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Jeux
									</a>
									<ul class="dropdown-menu dropdown-menu-dark">
										<li><a class="dropdown-item" href="jeux2.php">Tous les jeux</a></li>
										<li><a class="dropdown-item" href="favoris.php">Mes favoris</a></li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav3" href="planning.php"> Planning </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav4" href="admin.php"> Admin </a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav5" href="profil.php">Profil</a> 
								</li>
								<li class="nav-item">
									<a class="nav-link" id="nav6" href="code/deconnection.php">Déconnection</a>
								</li>

								
							<?php 
						}
						

					}
					else
					{
						?>
						<li class="nav-item">
							<a id="nav5" class="nav-link" href="connection.php"> Connection </a> 
						</li>
						<li class="nav-item">
							<a id="nav6" class="nav-link" href="inscription.php"> Inscription </a>
						</li>						
						<?php  
					}
				?>
				</ul>
			</div>
			</div>
		</div>
	</nav> </br></br></br></br>

