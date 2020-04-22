<?php session_start(); ?>
<!doctype HMTL>
<html >

    <head>
        <title>OPEN SOPRA STERIA </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>
 <body>

     <div class = "block1"> <!-- page d'accueil du site ! -->
     <h1>OPEN TOURNOI SOPRA STERIA</h1>


         <div class = "block3">
             <nav>
             <ul id = "menu"><!-- menu de navigation du site -->
                <li><img src="logosopra.png" width="70%" height="70%"> </li>
                 <li><a href = "joueur.php"> Adminstration des joueurs </a> </li>
                 <li> <a href = "planning1.php"> Administration des matchs </a></li>
                 <li> <a href="admin.php">  Administration de la billeterie </a></li>
                 <li> <a href="score.php"> Administration des scores </a></li>

                 <?php

                if(isset($_SESSION['mail'])){
                    //echo '<a href = "moncompte.php"><button class="favorite styled" type="button"> Billeterie </button></a></input>';
                    echo '<form action="" method="post">';
                    echo '<input class="favorite styled" type="submit" name="deco" value="Se deconnecter">';
                    echo '</form>';
                    	if(isset($_POST['deco']))
                    	{

                    		 include_once("ClasseConnexion.php");
                    		 $co = new Connection();
                             $co->disconnect();

                    	}
                }
                else{
                  //echo '<body onLoad="alert(\' Acces refusé \')">';
                  //echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
                }
                ?>

                </ul></nav></div>


<!-- Mise en forme-->
<div class = "container">
  <div class = "bloc1">
  </div>

  <div class = "bloc22">
    <div class = "titres">
      <h2 class = "texteaccueil">Ajouter un joueur</h2>
    </div>

    <div class = "inscription">
      <center>
        <!-- Formulaire de saisie-->
        <form method="post">

          <h6>Indiquer le nom du joueur :</h6>
          <input type="text" name="nomjoueur" />
          <br />

          <h6>Indiquer le prénom du joueur :</h6>
          <input type="text" name="prenomjoueur" />
          <br />

          <h6>Indiquer la date de naissance du joueur :</h6>
          <input type="date" id="start" name="datenaissance"
          min="1900-01-01" max="2009-12-31">
          <br />

          <h6>Indiquer la nationalité du joueur :</h6>
          <input type="text" name="nationalite" />
          <br />

          <h6>Indiquer le classement ATP du joueur :</h6>
          <input type="text" name="classementATP" />
          <br />

          <br />
          <input type="submit" value="valider" name="validerJ" />
          <br />

        </form>
      </center>

      <!-- Récupération des variables et envoie à la fonction-->
      <?php

        if(isset($_POST['validerJ'])){
          $nom = $_REQUEST['nomjoueur'];
          $prenom = $_REQUEST['prenomjoueur'];
          $daten = $_REQUEST['datenaissance'];
          $pays = $_REQUEST['nationalite'];
          $atp = $_REQUEST['classementATP'];

          //Test
          //echo $nom." ".$prenom." "."<br />".$daten." ".$pays." ".$atp;

          //Fonction
          $maConnexionBD->ajoutJoueur($nom,$prenom,$daten,$pays,$atp);
        }
      ?>
    </div>
  </div>
</div>
