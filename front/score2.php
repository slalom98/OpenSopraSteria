<?php session_start();
include_once("ClasseConnexion.php");
$co = new Connection();?>
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
             <nav><ul id = "menu"><!-- menu de navigation du site -->
                <li><img src="logosopra.png" width="70%" height="70%"> </li>
                 <li><a href = "joueur.php"> Adminstration des joueurs </a> </li>
                 <li> <a href = "planning1.php"> Administration des matchs </a></li>
                 <li> <a href="admin.php">  Administration de la billeterie </a></li>
                 <li> <a href="score.php"> Administration des scores </a></li>

                 <?php
                  if(isset($_SESSION['mail'])){
                      //echo '<a href = "moncompte.php"><button class="favorite styled" type="button"> Billeterie </button></a></input>';
                      echo '<form action="" method="post">';
                      echo '<input class="favorite styled" type="submit" name="deco" value="Se déconnecter">';
                      echo '</form>';
                      	if(isset($_POST['deco']))
                      	{
                               $co->disconnect();
                      	}
                  }
                  else{
                    //echo '<body onLoad="alert(\' Acces refusé \')">';
                    //echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
                  }
                ?>

                </ul></nav>
         </div>
         <!-- Récupération du match dans le formulaire, des joueurs dans la bd -->
         <?php
            $idmatch=$_POST['idmatch'];
            if($idmatch!=null){
              $tournoi=$co->getTournoi($idmatch);
              if($tournoi=='Tournoi simple'){
                $joueurA1=$co->getJoueurA1($idmatch);
                $joueurB1=$co->getJoueurB1($idmatch);
                $joueurA2=null;
                $joueurB2=null;
              }
              else {
                $joueurA1=$co->getJoueurA1($idmatch);
                $joueurB1=$co->getJoueurB1($idmatch);
                $joueurA2=$co->getJoueurA2($idmatch);
                $joueurB2=$co->getJoueurB2($idmatch);
              }
            }
            else{
              echo "Erreur lors de la récupération du match.";
            }
          ?>

         <div class = "container">
           <div class = "bloc1">
           </div>

           <div class = "bloc22">
             <div class = "titres">
               <h2 class = "texteaccueil">Renseigner les jeux par set et par équipe.</h2>
               <!-- Rappel : au tennis 7 jeux max par set, pour 3 sets max -->
             </div>

             <div class = "inscription">
               <center>
                 <form method="post" id="demoForm" class="demoForm">
                   <table border="1" cellspacing="2" cellpadding="2">
                     <tr><!--Première ligne du tableau-->
                       <!--Première cellule-->
                       <td align="center">
                         Equipe A<br/>
                         <?php
                            if($tournoi=='Tournoi simple'){
                              $j = $joueurA1;
                              $repA1 = $co->getNomJoueur($j);
                              echo $repA1;
                            }
                            else {
                              $j = $joueurA1;
                              $repA1 = $co->getNomJoueur($j);
                              $j = $joueurA2;
                              $repA2 = $co->getNomJoueur($j);
                              echo $repA1." et ".$repA2;
                            }
                          ?>
                       </td>
                       <!--Deuxième cellule-->
                       <td align="center">
                         Equipe B<br/>
                         <?php
                            if($tournoi=='Tournoi simple'){
                              $j = $joueurB1;
                              $repB1 = $co->getNomJoueur($j);
                              echo $repB1;
                            }
                            else {
                              $j = $joueurB1;
                              $repB1 = $co->getNomJoueur($j);
                              $j = $joueurB2;
                              $repB2 = $co->getNomJoueur($j);
                              echo $repB1." et ".$repB2;
                            }
                          ?>
                       </td>
                     </tr><!--Fin de la première ligne du tableau-->
                     <?php
                        //Variable qui permet d'éviter le recopie de lignes de code
                        $options = '<option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                    <option value=6>6</option>
                                    <option value=7>7</option>';
                      ?>
                     <tr><!--Ligne set n°1-->
                       <td align="center"><!--Equipe A-->
                            Jeux remportés lors du set n°1<br/>
                            <?php
                                echo '<select name="Aset1">'.
                                      $options.'</select>';
                             ?>
                       </td>
                       <td align="center"><!--Equipe B-->
                            Jeux remportés lors du set n°1<br/>
                            <?php
                                echo '<select name="Bset1">'.
                                      $options.'</select>';
                             ?>
                       </td>
                     </tr>

                     <tr><!--Ligne set n°2-->
                      <td align="center"><!--Equipe A-->
                           Jeux remportés lors du set n°2<br/>
                           <?php
                               echo '<select name="Aset2">'.
                                     $options.'</select>';
                            ?>
                      </td>
                      <td align="center"><!--Equipe B-->
                           Jeux remportés lors du set n°2<br/>
                           <?php
                               echo '<select name="Bset2">'.
                                     $options.'</select>';
                            ?>
                      </td>
                     </tr>

                     <tr><!--Ligne set n°3-->
                      <td align="center"><!--Equipe A-->
                           Jeux remportés lors du set n°3<br/>
                           <?php
                               echo '<select name="Aset3">'.
                                     $options.'</select>';
                            ?>
                      </td>
                      <td align="center"><!--Equipe B-->
                           Jeux remportés lors du set n°3<br/>
                           <?php
                               echo '<select name="Bset3">'.
                                     $options.'</select>';
                            ?>
                      </td>
                     </tr>

                   </table>
                   <br/>
                   <input type="submit" value="Confirmer ce score" name="valider" />
                   <br />
                   <?php //Récupération des scores par set des équipes, puis fonction
                     if(isset($_POST['valider'])){
                       $Aset1 = $_REQUEST['Aset1'];
                       $Bset1 = $_REQUEST['Bset1'];
                       $Aset2 = $_REQUEST['Aset2'];
                       $Bset2 = $_REQUEST['Bset2'];
                       $Aset3 = $_REQUEST['Aset3'];
                       $Bset3 = $_REQUEST['Bset3'];

                       $co->ajoutScore($idmatch,$joueurA1,$joueurB1,$joueurA2,$joueurB2,
                                       $Aset1,$Bset1,$Aset2,$Bset2,$Aset3,$Bset3);
                     }
                   ?>
                 </form>
               </center>
             </div>
           </div>

     </div>
 </body>
</html>
