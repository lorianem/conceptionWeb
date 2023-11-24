<?php
// Démarrage de la session
session_start();
include 'code/EnTete.php';

// Connexion à la base de données avec PDO
try {
    $bdd = new PDO('mysql:host=localhost;dbname=site_jeux;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Liste des Jeux</title>
    <style>
        img src='image/jeux/' {
            width="350px";
            height="80px";
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .search-container {
            padding: 10px;
            background-color: #f8f9fa;
            text-align: center;
        }
        .search-container input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .search-container button {
            padding: 10px 20px;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            border: none;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .liste-jeux {
            margin: 20px;
        }
        .jeu {
            background-color: white;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .jeu img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .jeu h2 {
            cursor: pointer;
            color: #007bff;
            display: inline-block;
            margin-right: 10px;
        }
        .like-button {
            font-size: 24px;
            line-height: 1;
            color: #ff4081; /* Couleur initiale pour un like actif */
            cursor: pointer;
            border: none;
            background: none;
        }
        .like-button.inactive {
            color: #ccc; /* Couleur pour un like inactif */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bienvenue sur la Page des Jeux</h1>
    </div>

    <div class="search-container">
    <input type="text" placeholder="RECHERCHE">
    <button>&#x1F50D;</button>
    <button id="show-favorites" onclick="showFavorites()">Favoris</button>
</div>

   

<div class="liste-jeux">
    <?php
    $sql = "SELECT id, nom, description FROM jeux";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
          // Liste des extensions d'image possibles
$possibleExtensions = ['jpg', 'jpeg', 'png', 'gif'];

// Construire le chemin de l'image
    $imageBasePath = "image/jeux/" . urlencode($row["nom"]);
    $imagePath = "";
    foreach ($possibleExtensions as $ext) {
    $tempPath = $imageBasePath . '.' . $ext;
    if (file_exists($tempPath)) {
    $imagePath = $tempPath;
    break;
  } 
}
            echo "<img src='" . htmlspecialchars($imagePath) . "' alt='" . htmlspecialchars($row["nom"]) . "' width='350px' height='350px'>";

            echo "<div class ='jeu' data-game-id='" . $row['id'] ."'\">";
            
            echo "<h2 onclick=\"location.href='jeu.php?id=" . $row['id'] . "'\">" . htmlspecialchars($row["nom"]) . "</h2>";
            echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
            // Bouton "like"
            echo "<button class='like-button inactive' onclick='toggleLike(this, " . $row['id'] . ")'>&hearts;</button>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun jeu trouvé.</p>";
    }
    ?>
</div>

    
    
    <script>
        //Initilisation liked games
    var likedGames = JSON.parse(localStorage.getItem('likedGames')) || {};
    document.addEventListener('DOMContentLoaded', function() {
    var allGames = document.querySelectorAll('.jeu');
    allGames.forEach(function(game) {
        var gameId = game.getAttribute('data-game-id');
        var likeButton = game.querySelector('.like-button');
        if (likedGames[gameId]) {
            likeButton.classList.remove('inactive');
        } else {
            likeButton.classList.add('inactive');
        }
    });
});
    // Fonction appelée lors du chargement de la page pour mettre à jour l'état des boutons "like"
    document.addEventListener('DOMContentLoaded', function() {
    var allGames = document.querySelectorAll('.jeu');
    allGames.forEach(function(game) {
        var gameId = game.getAttribute('data-game-id');
        var likeButton = game.querySelector('.like-button');
        if (likedGames[gameId]) {
            likeButton.classList.remove('inactive');
        } else {
            likeButton.classList.add('inactive');
        }
    });
});

    function toggleLike(button, gameId) {
    button.classList.toggle('inactive');
    if (button.classList.contains('inactive')) {
        delete likedGames[gameId];
    } else {
        likedGames[gameId] = true;
    }
    localStorage.setItem('likedGames', JSON.stringify(likedGames));
}


    function showFavorites() {
        var allGames = document.querySelectorAll('.jeu');
        allGames.forEach(function(game) {
            var gameId = game.getAttribute('data-game-id');
            if (!likedGames[gameId]) {
                game.style.display = 'none';
            } else {
                game.style.display = '';
            }
        });
    }
</script>



</body>

<?php include 'PiedPage.php'?>
</html>
