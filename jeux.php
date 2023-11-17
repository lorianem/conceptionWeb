<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jeux</title>
  </head>

  <body>
  <nav class="navbar navbar-expand-md bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jeux.php">Jeux</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planning.php">Planning</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planning.php">Planning</a>
        </li>
        <!-- Si role est existe dans la session, l'utilisateur est connecté  -->
              </ul>
      <ul class="navbar-nav mb-lg-0">
        <!-- Utilisateur non connecté (on affiche Inscription et Connection) -->
                <li class="nav-item">
          <a class="nav-link"  href="inscription.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
        <!-- Sinon on affiche la Déconnexion -->
        

      </ul>

    </div>
  </div>
</nav>