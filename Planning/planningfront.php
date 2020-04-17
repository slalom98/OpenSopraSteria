<?php session_start(); 
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Planning </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./design.css"/>
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

                 
              <div class = "container">
                 <div class = "bloc2">
                     
                 </div>

                 <div class = "bloc3">
                     <div class = "titres">
                         <h2  class = "texteaccueil" align="center">Visualiser planning match</h2>
                     </div>
                    <br><br>
                    <?php
                       echo '<table border="1" cellspacing="2" cellpadding="2" align="center">
                       <tr>
                			<td align="center">Date</td>
                			<td align="center">Affiche</td>
                			<td align="center">Créneau</td>
                	   </tr>';
                       $tab= $maConnexionBD->afficherMatch();
                       foreach ($tab as $key => $value) {
                           echo '<tr><td align="center">'.$value['dateMatch'].'</td>';
                           echo '<td align="center">'.$value['libelleMatch'].'</td>';
                           echo '<td align="center">'.$value['creneauMatch'].'</td>';
                           echo '</tr>';
                        }
                       echo '</table>';
                    ?>
                
                </div>    
                        
  
           </body>
    </html>
