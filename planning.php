<?php include("code/EnTete.php") ?>
<?php include("code/relocalisationVisiteur.php")?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Planning</title>
        <style>
            table {
                border-collapse: collapse;
                width: 60%; /* Largeur totale du tableau */
                margin: 80px; /* Marge autour du tableau */
            }

            th, td {
                border: 1px solid black;
                padding: 5px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2; /* Couleur de fond pour les cellules d'en-tête */
            }

            /* Définir une largeur spécifique pour chaque colonne */
            th:nth-child(1), td:nth-child(1) {
                width: 20%;
            }

            th:nth-child(2), td:nth-child(2) {
                width: 15%;
            }

            th:nth-child(3), td:nth-child(3) {
                width: 10%;
            }

            th:nth-child(4), td:nth-child(4) {
                width: 25%;
            }

            th:nth-child(5), td:nth-child(5) {
                width: 30%;
            }
        </style>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>

        <h1>PLANNING<h1>
        <style>
            h1 {
                display: flex;
                justify-content: center; /* Centre horizontalement */
                align-items: center; /* Centre verticalement */
                height: 10vh; /* Pour occuper la hauteur complète de la vue */
            }

            .center-text {
                text-align: center; /* Centre le texte à l'intérieur du conteneur */
            }
        </style>

        <style>
            table {
                border-collapse: collapse; /* Fusionner les bordures de cellules */
                width: 100%; /* Occuper la largeur complète du conteneur parent */
            }

            th, td {
                border: 1px solid black; /* Bordure de chaque cellule */
                padding: 8px; /* Espace intérieur de la cellule */
                text-align: center; /* Centrer le texte dans la cellule */
            }
        </style>

        <main>
            <table >
                <tr>
                    <th>Jeu</th>
                    <th>Niveau</th>
                    <th>Date</th>
                    <th>Rang</th>
                    <th>Etat</th>
                    <style>
                        th {
                            font-size : 1.0em;
                            
                        }
                    </style>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </main>
        

    </body>




</html>