<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php") ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titre de la Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <section class='center'>
            <style>
                .center {
                    text-align: center;
                }
            </style>
            <?php
            // Charger les informations dynamiques de l'administrateur depuis la base de données
            // Vous devez remplacer "votre_image.jpg" par le chemin vers l'image fournie par l'administrateur
            $imagePath = "votre_image.jpg"; 
            ?>
            <img src="<?= $imagePath ?>" class="img-thumbnail" alt="Error" width="350px" height="80px">
        </section>

        <section>
            <?php
            // Charger les informations dynamiques de l'administrateur depuis la base de données
            $titrePage = "Titre Dynamique";
            $textePage = "Description dynamique de la page.";
            $urlReglesJeu = "lien_vers_regles_du_jeu.php";
            ?>
            <h5 style="text-align: center;"><?= $titrePage ?></h5>
            <p><?= $textePage ?></p>
            <a id="nav2" href="<?= $urlReglesJeu ?>"> Règles du jeu </a>
            <br><br>
            <div class="d-grid gap-2 col-2 mx-auto">
                <button type="button" class="btn btn-warning">Rejoindre la partie</button>
            </div>
        </section>
    </main>
</body>

</html>



