<?php
session_start(); 
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
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

             
                         <h2  class = "texteaccueil">Mon panier</h2>
                             <center>
                                 <form action = "panier.php" method="post">
                                 <h6> Votre billet  :</h6> 
                                  <br>
                                 <?php 
                                 echo"Votre Idbillet : ".$_SESSION['idmatchcommande'];
                                 echo "<br>";
                                 echo "Votre match :".$_SESSION['libellematchcommande'];
                                 echo "<br>";
                                 echo"Votre type de billet :".$_SESSION['libelletbillet'];
                                 echo "<br>";
                                 echo "Votre emplacement : ".$_SESSION ['libelleemplacement']?>
<br>
                                 <h6> Prix total : </h6>
                                 
                                  
                                 
                                     <?php
                                   $tabE=$maConnexionBD->prixtotalbillet(); ?>
                                 
                                 <output type = 'text' name = "billet">  </output> <br/>
                                     
                                
                                  <p>
                                     <input type="submit" value="suivant" name="co">
                                 </p>
                                      </form>
                                     </center>
           
           </body>
           </html>