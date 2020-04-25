<?php session_start(); ?>

<html>
    <head>
        <title>Open Sopra Steria | Connexion </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css"/>
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
                <img class = "raquette" src = raquette.png>
            </div>

            <div class = "bloc2">
                <div class = "titres">
                    <img class = "logoconnexion" src = "logoconnexion.png">
                    <h2  class = "texteaccueil">Espace Client Open Sopra Steria</h2>
                </div>

                <div class = "connexion">
                    <div class = "blocId">
                        <center>
                            <form action = "seconnecter.php" method="post">
                            <h6>Email :</h6>
                            <input name="login">
                            <h6>Mot de Passe :</h6>
                            <input type="password" name="pass">
                            <input type="submit" value="Connexion" name="co">
                            </p>
                            <!--Il faudra mettre du php pour vérifier les id et mdp quand le bouton connexion est pressé-->
                            <!--Si le code n'est pas le bon, prévoir un echo "Identifiant ou mot de passe incorrect"-->

                            <a href="recupererId.html"target=_blank><h6>Mot de passe oublié</h6></a>

                            <!--Si tout est bon, faire lien vers l'espace client-->
                        </form>

                        <?php
                        include_once("ClasseConnexion.php");


                            try {
                                $maConnexionBD = new Connection(); //nouvel objet connexion

                            	if(isset($_POST['co']))
                            	{
                            		$login = $_REQUEST['login'];
                            		$pass = $_REQUEST['pass'];

                            	   	$maConnexionBD->connexion($login,$pass);


                            	}
                            	else {
                            	    $_POST['co'] = NULL;
                            	}
                            }
                            catch (Exception $e) {

                            }


                        ?>

                        </center>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
