<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Inscription </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="design.css"/>
    </head>

    <body>

      <div class = "block3">
          <nav>
          <ul id = "menu"><!-- menu de navigation du site -->
             <li><img src="logosopra.png" width="70%" height="70%"> </li>
              <li><a href = "#"> Actualités </a> </li>
              <li> <a href = "#">  Billeterie </a></li>
              <li> <a href="#">Planning Match</a></li>
              <li> <a href="#">Résultats</a></li>
             <a href = "seconnecter.php"><button class="favorite styled" type="button"> Se Connecter </button></a>
             <a href = "sinscrire.php"><button class="favorite styled" type="button"> S'Inscrire </button></a>
             </ul></nav></div>

             <div class = "container">
                 <div class = "bloc1">

                 </div>

                 <div class = "bloc2">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Espace Inscription</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                 <form action = "sinscrire.php" method="post">
                                 <h6> Nom :</h6>
                                     <input type="text" name="nom"><br/>
                                <h6>Prénom :</h6>
                                     <input type="text" name="prenom"><br/>
                                 <h6>Téléphone :</h6>
                                     <input type="text" name="telephone"><br/>
                                 <h6>Adresse Mail :</h6>
                                     <input type="text" name="mail"><br/>
                                 <h6>Mot de passe :</h6>
                                     <input type="password" name="pass1"><br/>
                                 <h6>Confirmation du mot de passe :</h6>
                                     <input type="password" name="pass2"><br/>
                                  <p>
                                     <input type="submit" value="Inscription" name="co">
                                 </p>
                             </form>
                             <?php
                             include_once("ClasseConnexion.php");
                             $maConnexionBD = new Connection(); //nouvel objet connexion
                          	 if(isset($_POST['co'])){
                            	    $nom = $_REQUEST['nom'];
                            	    $prenom = $_REQUEST['prenom'];
                            	    $telephone = $_REQUEST['telephone'];
                              		$mail = $_REQUEST['mail'];
                              		$pass1 = $_REQUEST['pass1'];
                              		$pass2 = $_REQUEST['pass2'];

                              		if ($pass1!=$pass2 ){
                              		     echo '  <body onLoad="alert(\'Erreur. Les deux mots de passe saisis sont différents.\')">   ';
                              		}
                              		else{
                                        $pass_crypte= password_hash($pass1, PASSWORD_BCRYPT); // cryptage du mdp
                                    	  $maConnexionBD->inscription($nom,$prenom,$telephone,$mail,$pass_crypte);

                              		}
                            	}


                            ?>
                             </center>
                         </div>
                     </div>
                 </div>
             </div>
           </body>
           </html>
