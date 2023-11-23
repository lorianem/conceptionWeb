<?php include("code/EnTete.php"); ?>
<?php include("code/relocalisationVisiteur.php"); ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titre de la Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .selected-row {
            background-color: #d4edda;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .flex-container > section {
            flex: 1;
            margin-right: 20px;
        }
        .flex-container > section:last-child {
            margin-right: 0;
        }
        .img-container img {
            max-width: 100%;
            height: auto;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<main>
<div class="flex-container" style="margin: 20px;">
            <section class='center'>
                <?php
                $imagePath = "chemin_image.jpg"; 
                ?>
                <img src="<?= $imagePath ?>" class="img-thumbnail" alt="Error" width="350px" height="80px">
            </section>

            <section>
                <?php
                $titrePage = "Titre Dynamique";
                $textePage = "Description dynamique de la page.";
                $urlReglesJeu = "lien_vers_regles_du_jeu.php";
                ?>
                <h5 style="text-align: center;"><?= $titrePage ?></h5>
                <p><?= $textePage ?></p>
                <a id="nav2" href="<?= $urlReglesJeu ?>">Règles du jeu</a>
                <br><br>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <button type="button" class="btn btn-warning">Rejoindre la partie</button>
                </div>
            </section>


        <section class='center'>
            <style>
                .center{
                    text-align: center;
                }
            </style>
            <img src="image/jeux/Dixit.jpg" class="img-thumbnail" alt="Error"
            width="350px"
            height="80px">
        </section>

        <section>
        <h2>Créneaux des parties</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Places</th>
                    <th scope="col">Date/Heure</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Durée</th>
                    <!-- Suppression de la colonne Participants -->
                </tr>
            </thead>
            <tbody>
                <!-- Première ligne de données -->
                <tr onclick="selectRow(this)">
                    <td><div>
                        <input type="checkbox" id="scales" checked />
                        <label for="scales"></label>
                        </div>
                    </td>
                    <td>20</td>
                    <td>30-11-2023 à 18:00</td>
                    <td>Intermédiaire</td>
                    <td>2 heures</td>
                </tr>
                <!-- Deuxième ligne de données -->
                <tr onclick="selectRow(this)">
                <td><div>
                        <input type="checkbox" id="scales" checked />
                        <label for="scales"></label>
                        </div>
                    </td>
                    <td>15</td>
                    <td>22-11-2023 à 14:30</td>
                    <td>Débutant</td>
                    <td>1.5 heures</td>
                </tr>
                <!-- Ajoutez d'autres lignes de données dynamiques ici -->
            </tbody>
        </table>
        </section>
    </div>

    <script>
        function selectRow(row) {
            var isRoxSelected = true;
            // Supprime la classe 'selected-row' de toutes les lignes
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(function (row) {
                row.classList.remove('selected-row');
            });

            // Ajoute la classe 'selected-row' à la ligne sélectionnée
            row.classList.add('selected-row');
        }

        if (isRowSelected) {
        row.classList.add('selected-row');
        }

        function toggleCheckbox(checkbox) {
            // Empêche la propagation de l'événement pour éviter de déclencher la sélection de ligne
            event.stopPropagation();
        }
    </script>

<?php
$placesRestantes = $places - 1;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($isRowSelected) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nom_du_bouton"])){
        $pseudo = $_POST['pseudo'];


        $stmt = $pdo->prepare("INSERT INTO planning (places, date, niveau, duree, participants) VALUES ($placesRestantes, $date, $niveau, $duree, $pseudo)");
        $stmt->execute([$placesRestantes, $date, $niveau, $duree, $pseudo]);

    // Réponse de succès (ou erreur selon le cas)
        echo json_encode(['success' => true, 'message' => 'Vous avez rejoint la partie avec succès.']);
        }
        else {
    // S'il essaie d'appuyer sur le bouton sans cocher aucune case
        echo 'Choisissez au moins un créneau.';
        }
    }
}
?>

</body>

</html>



