<?php include("code/EnTete.php") ?>
<?php

if(isset($_POST['envoyer']))
{

	// Gestion de ReCapcha
   	// Ma clé privée
  	$secret = "6LfSLdEUAAAAAI0I8-15FHss3BWiyOcVXjRowzOa";
  	// Paramètre renvoyé par le recaptcha
  	$response = $_POST['g-recaptcha-response'];
  	// On récupère l'IP de l'utilisateur
 	$remoteip = $_SERVER['REMOTE_ADDR'];
  
  	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
      . $secret
      . "&response=" . $response
      . "&remoteip=" . $remoteip ;
  
  	$decode = json_decode(file_get_contents($api_url), true);
   $nom = htmlspecialchars($_POST["nom"]);
   $prenom = htmlspecialchars($_POST["prenom"]);
   $pseudo = htmlspecialchars($_POST["pseudo"]);
   $mail = htmlspecialchars($_POST["mail"]);
   $mdp1 = htmlspecialchars($_POST["mdp1"]);
   $mdp2 = htmlspecialchars($_POST["mdp2"]);

   if ($decode['success'] == true) {
      
      if(  isset($_POST["nom"]) AND !empty($_POST["nom"]) AND isset($_POST["prenom"]) AND !empty($_POST["prenom"]) AND isset($_POST["pseudo"]) AND !empty($_POST["pseudo"])  AND isset($_POST["mail"]) AND !empty($_POST["mail"]) AND isset($_POST["mdp1"]) AND !empty($_POST["mdp1"]) AND isset($_POST["mdp2"]) AND !empty($_POST["mdp2"]) ) // Vérifie que tout est bien remplit 
         {

            if (strlen($pseudo) < "20" AND  strlen($prenom) < "20" AND strlen($nom) < "20"  ) // verifie que le nom, le prenom, le pseudo n'ont pas trop de caractère par rapprort à la base de donnée
            {
               if(filter_var($mail, FILTER_VALIDATE_EMAIL )) // Verifie que c'est un Mail conforme
               { 
                     try
                     {
                        $reqmail = $bdd->prepare("SELECT * FROM users WHERE email = ?"); // Cherche dans la base dans la colonne mail si celui-ci y est 
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount(); // Compte le nombre de colonne ou il y a cette donnée
                     }
                     catch(Exception $e)
                     {
                             die('Erreur : '.$e->getMessage());
                     }
                     

                     
                  	if($mailexist == 0)
                   	{    
                    	   $reqpseudo = $bdd->prepare("SELECT * FROM users WHERE pseudo = ?");
                  	   $reqpseudo->execute(array($pseudo));
                       	$pseudoexist = $reqpseudo->rowCount(); 

                      	if($pseudoexist == 0)
                        {
                        	if( $mdp1 == $mdp2 )// Verfie que les MDP sont identique 
                        	{
                           		if (strlen($mdp1) > "2" ) // verifie que le mot de passe a assez de caractère 
                           		{

   	                              $mdp = sha1($mdp1);
                                    //echo ("nom prenom pseudo email mdp . $nom, $prenom, $pseudo, $mail, $mdp . ");
   	                              $requete = $bdd -> prepare("INSERT INTO users(nom, prenom, pseudo, email, mdp) VALUES(?, ?, ?, ?, ?)");
   	                              $requete -> execute(array($nom, $prenom, $pseudo, $mail, $mdp));
   	                              $msg = " vous etes inscrit";
                           		}
	                           	else
	                           	{
	                             	$msg = "Le mot de passe n'est pas assez long ";
	                           	}
                        	}  
	                        else                 
	                        {
	                           $msg = "Les mots de passe ne sont pas similaire ";
	                        }  
                     	}
                     	else
                     	{
                        	$msg = "Votre pseudo existe";
                     	}  
                  	}
                  	else
                  	{
                     	$msg = "Votre e-mail exist";
                  	} 
               	}
               	else
               	{
                  	$msg = "Votre e-mail n'est pas conforme";
               	}
            }
            else
            {
               $msg = 'Ne remplissez pas de la erde dans les champs, NOM, Prenom, Pseudo !' ;
            }
      	}
      	else
      	{
         	$msg = "Remplissez tous les champs !";
     	}
   
   }
   else
   {
      $msg='Recapcha invalide';
   }

}
else
{
   $msg=" ";
}

?>


	<main>
		<div align="center"  class="page">
         <h2>Inscription</h2>
         <br />
         <form method="POST" action="" id="inscription">
            <table>
               <p id='erreurmess'></p> 
            	
            	<tr>
                  <td align="right">
                     <label for="nom">Nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre Nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Prenom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
                  </td>
               </tr>
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
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp1" name="mdp1" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td align="right"><label>Recapcha : </label></td>
                  <td>
                     <form method="POST">
                        <div class="g-recaptcha" data-sitekey="6LfSLdEUAAAAADYFitII6rlfJn6ePMHnz4KGPFie"></div>
                     </form>
                  </td>
               </tr>
               <tr>
                  <td align="right"><br> <a  href="connexion.php"> Se Connecter </a>  </td>   
                     
                  <td align="center">
                     <br />
                     <input type="submit" name="envoyer" value="Je m'inscris" />
                  </td>
               </tr>
               
            </table>
         </form><br>
         <?php
         echo '<font color="red">'.$msg."</font>";
         
         ?>
   
      </div>

	</main>


<?php include("code/PiedPage.html") ?>
