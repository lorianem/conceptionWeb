<?php
   session_start();
   //include("../../Code/Php/php_coockie.php");
   try
   {
      $bdd = new PDO('mysql:host=localhost;dbname=site_jeux;charset=utf8', 'root', 'root');
   }
   catch(Exception $e)
   {
           die('Erreur : '.$e->getMessage());
   }


 ?>