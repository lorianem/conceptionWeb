<?php include("connection_BDD.php") ?>

<?php
/*Changer la caouleur du bouton like */

if(isset($_GET['etat'],$_GET['id']) AND !empty($_GET['etat']) AND !empty($_GET['id'])) {
    $getid = (int) $_GET['id'];

    $check = $site_jeux->prepare('SELECT id FROM favories WHERE id = ?');
    $check->execute(array($getid));

}

?>