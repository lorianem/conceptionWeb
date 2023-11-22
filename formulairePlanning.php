<?php include("code/EnTete.php") ?>
<?php include("connection_BDD.php") ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire d'Administration</title>
</head>
<body>

    <form action="creer_planning.php" method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>
        <br>
        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <br>
        <label for="pdf">Fichier PDF (règles du jeu) :</label>
        <input type="file" id="pdf" name="pdf" accept=".pdf" required>
        <br>
        <input type="submit" value="Créer la Page">
    </form>

</body>
</html>