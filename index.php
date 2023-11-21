<?php include("code/EnTete.php") ?>

<h1>HOME</h1>
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

    <nav>
        <img src="image/jeux-societe-voyage.jpg" class="img-fluid" alt="Error">
    </nav>
    
    <div class="flex-container" style="margin : 20px;">
        <section>
            <h2>Qui sommes-nous?</h2>
            <p>Nous sommes un regroupement de passionnés de jeux de société, ou des néophytes souhaitant découvrir les jeux de société. Notre local est situé dans le cœur de Rouen, n'hésitez pas à nous rendre visite.</p>
        </section>

        <section>
            <h3>Que faisons-nous?</h3>
            <p>Nous organisons des activités autour des jeux de société. Parmi ceux-ci :
                <br> 
                - Découverte de jeux de société
                <br> 
                - Des jeux de rôles
                <br>
                - Des tournois
            </p>
        </section>
    </div>
    
    <h4>Présentation de quelques jeux</h4>
        <style>
            h4 {
                    display: flex;
                    justify-content: center; /* Centre horizontalement */
                    align-items: center; /* Centre verticalement */
                    height: 10vh; /* Pour occuper la hauteur complète de la vue */
                }

            .center-text {
                    text-align: center; /* Centre le texte à l'intérieur du conteneur */
                }
        </style>
    
    <br>

    <div class="flex-container" style="margin : 40px;">
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
            <h5 style="center">Dixit</h5>
            <p> Dixit est un jeu où les joueurs s'expriment par des cartes illustrées, inventent des histoires et essaient de deviner 
                la carte du conteur. La créativité et l'intuition sont essentielles pour marquer des points. </p>
        </section>
    </div>


    <div class="flex-container" style="margin : 40px;">
        <section>
            <h5 style="center">Monopoly</h5>
            <p> Le Monopoly est un jeu où les joueurs achètent, échangent et construisent des propriétés pour accumuler des richesses. 
                En lançant les dés, ils se déplacent autour du plateau, perçoivent des loyers et négocient pour devenir le magnat 
                immobilier le plus prospère. Le jeu mêle stratégie financière, négociations et rebondissements inattendus. </p>
        </section>

        <section class='center'>
            <style>
                .center{
                    text-align: center;
                }
            </style>
            <img src="image/jeux/Monopoly.jpg" class="img-thumbnail" alt="Error"
            width="350px"
            height="80px">
        </section>
    </div>




<?php include("code/PiedPage.html") ?>
