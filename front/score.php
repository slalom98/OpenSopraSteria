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
