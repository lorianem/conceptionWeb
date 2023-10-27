<?php  //include(connection_BDD.php);   

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

<?php 


//var_dump(array($_COOKIE));

if (isset($_POST['connexion'])) // Si on appui sur le bouton
{  
  $pseudo = htmlspecialchars($_POST["pseudo"]);
  $mdp = password_hash(htmlspecialchars($_POST["mdp"]), PASSWORD_DEFAULT)  ;
   

   if ( !empty($pseudo) AND !empty($mdp))
   {
      echo "-1";

     $reqpseudo = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
     $reqpseudo->execute(array($pseudo));
     $pseudoexist = $reqpseudo->rowCount();
      
     if ($pseudoexist == 1)
     {
         
        $requetes = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?"); 
        $requetes->execute(array($pseudo));
        $resultat =  $requetes->fetch();
        //$isPasswordCorrect = password_verify($_POST['mdp'] , $resultat['mdp']);
        $mdp=sha1($_POST["mdp"]);
        //echo $mdp;
        
        if ($mdp == $resultat['mdp'])
        {
         
          //var_dump($isPasswordCorrect); 
          //session_start();
          $_SESSION['pseudo'] = $resultat['pseudo'];
          $_SESSION['id'] = $resultat['id'];
          $_SESSION['mail'] = $resultat['email'];
          $_SESSION['prenom'] = $resultat['prenom'];
          $_SESSION['nom'] = $resultat['nom'];

          
          //echo $isPasswordCorrect;
          if(isset($_POST['se_souvenir'])){

            setcookie('pseudo',$pseudo,time()+365*24*3600,null,null,false,true);
            setcookie('mdp',$mdp,time()+365*24*3600,null,null,false,true);
           
           // var_dump(array($_COOKIE));
          }
            echo  "connecté";
        }
        else
         {
            $msg = "Mot de passe incorrect" ;
         }
      
     }
     else
     {
      $msg = "Pseudo inexistant";
     }


   }
   else
   {
     $msg =  "Remplissez tous les champs";
   }  
}




 ?>


<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Lukido</title>
</head>
<body>
     <div align="center"  class="page">
         <h2>Connexion</h2>
         <br />
         <form method="POST" action="">
            <table>

               <tr>
                  <td align="right">
                     <label for="pseudo">Pseudo :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                  </td>
               </tr>

               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>

               <tr>
                  <td><label>Se souvenir de moi : </label></td>
                  <td><input type="checkbox" name="se_souvenir" id="se_souvenir"></td>
               </tr>
               <tr>
                  <td align="center"><br><a href="../../Page/Compte/inscription.php"> S'inscrire </a></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="connexion" value="Connexion" />
                  </td>
               </tr>

            </table>
         </form>
         
         <?php
         if(isset($msg)){echo '<font color="red">'.$msg."</font>";}
         ?>
      </div>


   </body>
</html>
</body>
</html>