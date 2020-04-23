<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Planning </title>
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

                 </div>


              <div class = "container">
                 <div class = "bloc2">

                 </div>

                 <div class = "bloc3">
                     <div class = "titres">
                         <h2  class = "texteaccueil" align="center">Matchs joués</h2>
                     </div>
                    <br><br>
                    <?php
                       $tabM= $maConnexionBD->getmatchsjoues();
                       if (empty($tabM)==FALSE){
                         foreach ($tabM as $keyM => $valueM) {
                             echo '<center><fieldset>';
                             echo 'Date : '.$valueM['dateMatch'].', ';
                             echo  $valueM['creneauMatch'].'. Match : ';
                             echo  $valueM['libelleMatch'].'<br/><br/>';

                             $idmatch = $valueM['idmatch'];
                             $scoreA = $maConnexionBD->getscoreA($idmatch);
                             $scoreB = $maConnexionBD->getscoreB($idmatch);

                             if($valueM['tournoi']=='Tournoi double'){

                              $tabA = $maConnexionBD->getEquipeA($idmatch);
                              $tabB = $maConnexionBD->getEquipeB($idmatch);
                              echo '<table border="1" cellspacing="2" cellpadding="2" align="center">';
                              //Première ligne : Equipe A
                       			  echo '<tr><td align="center">';
                              echo  $tabA[0][1].' et '.$tabA[0][2].'</td>';
                              foreach($scoreA as $keyA => $valueA){
                                echo '<td align="center">'.$valueA['nbjeux'].'</td>';
                              }
                              echo '</tr>';

                              //Deuxième ligne : Equipe B
                              echo '<tr><td align="center">';
                              echo  $tabB[0][1].' et '.$tabB[0][2].'</td>';
                              foreach($scoreB as $keyB => $valueB){
                                echo '<td align="center">'.$valueB['nbjeux'].'</td>';
                              }
                              echo '</tr>';

                              echo '</table>';
                              echo '</fieldset></center><br/><br/>';
                            }
                            else{//tournoi simple

                              $tabJ = $maConnexionBD->getJoueursSimple($idmatch);

                              echo '<table border="1" cellspacing="2" cellpadding="2" align="center">';
                              //Première ligne : Equipe A
                       			  echo '<tr><td align="center">';
                              echo  $tabJ[0][1];
                              foreach($scoreA as $keyA => $valueA){
                                echo '<td align="center">'.$valueA['nbjeux'].'</td>';
                              }
                              echo '</tr>';

                              //Deuxième ligne : Equipe B
                              echo '<tr><td align="center">';
                              echo  $tabJ[0][2];
                              foreach($scoreB as $keyB => $valueB){
                                echo '<td align="center">'.$valueB['nbjeux'].'</td>';
                              }
                              echo '</tr>';

                              echo '</table>';
                              echo '</fieldset></center><br/><br/>';

                            }
                          }
                        }

                    ?>

                </div>
            </div>

            <div class = "container">
               <div class = "bloc2">

               </div>

               <div class = "bloc3">
                   <div class = "titres">
                       <h2  class = "texteaccueil" align="center">Matchs à venir</h2>
                   </div>
                  <br><br>
                  <?php
                   echo '<table border="1" cellspacing="2" cellpadding="2" align="center">
                   <tr>
                   <td align="center">Date</td>
                   <td align="center">Affiche</td>
                   <td align="center">Créneau</td>
                   </tr>';
                   $tab= $maConnexionBD->getmatchsavenir();
                   if(empty($tab)==FALSE){
                     foreach ($tab as $key => $value) {
                         echo '<fieldset>';
                         echo '<tr><td align="center">'.$value['dateMatch'].'</td>';
                         echo '<td align="center">'.$value['libelleMatch'].'</td>';
                         echo '<td align="center">'.$value['creneauMatch'].'</td>';
                         echo '</tr></fieldset>';
                      }
                   }
                   echo '</table>';
                  ?>

              </div>
            </div>
    </body>
</html>
