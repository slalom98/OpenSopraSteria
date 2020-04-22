<?php session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
?>
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


            <!-- récupere les valeures de planning 1-->
             <?php
             $libelleMatch=$_POST['libelleMatch'];
             $dateMatch= $_POST['dateMatch'];
             $coefMatch=$_POST['coefMatch'];
             $courtMatch=$_POST['courtMatch'];
             $creneauMatch=$_POST['creneauMatch'];
             $tournoi=$_POST['tournoi'];
             $typeMatch =$_POST['typeMatch'];
             ?>


             <div class = "container">
                 <div class = "bloc1">

                 </div>

                 <div class = "bloc22">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajouter un match</h2>
                     </div>
                 <div class = "inscription">

                    <center>
                      <form method="post" id="demoForm" class="demoForm">
                         <fieldset>

                         <h6>Sélectionner l'équipe d'arbitres en charge du match</h6>

                         <select onChange="getSelected(this);" name="arbitre">
                            <?php

                            $tabA=$maConnexionBD->getArbitre();

                            // var_dump($tabA);
                            echo "<option value='' > " ;

                            foreach ($tabA as $key => $value ) {
                                echo " <option value=".$value['equipeArbitre']." > ";
                                echo $value['libelleEquipeA'];
                                echo "</option>";
                            }

                            if(isset($_GET["var1"])){
                                $equipeA=$_GET["var1"];

                                foreach ($tabA as $key => $value ) {
                                    if($value['equipeArbitre']==$equipeA) {
                                        echo  $value['libelleEquipeA'] . " selectionnée."  ;
                                    }
                                }
                            }



                            echo" </select>";

                            ?>


                         </select>

                         <h6>Sélectionner la première équipe de ramasseurs</h6>
                         <select onChange="getSelected(this);" name="ramasseurs1">
                            <?php

                            $tabR1=$maConnexionBD->getRamasseur();

                            // var_dump($tabR1);
                            echo "<option value='' > " ;

                            foreach ($tabR1 as $key => $value ) {
                                echo " <option value=".$value['equipeRamasseurs']." > ";
                                echo $value['libelleEquipeR'];
                                echo "</option>";
                            }

                            if(isset($_GET["var1"])){
                                $equipeR1=$_GET["var1"];

                                foreach ($tabR1 as $key => $value ) {
                                    if($value['equipeRamasseurs']==$equipeR1) {
                                        echo  $value['libelleEquipeR'] . " selectionnée comme équipe 1."  ;
                                    }
                                }
                            }



                            echo" </select>";

                            ?>

                            <h6>Sélectionner la deuxième équipe de ramasseurs</h6>
                            <select onChange="getSelected(this);" name="ramasseurs2">
                            <?php

                            $tabR2=$maConnexionBD->getRamasseur();

                            // var_dump($tabR1);
                            echo "<option value='' > " ;

                            foreach ($tabR2 as $key => $value ) {
                                echo " <option value=".$value['equipeRamasseurs']." > ";
                                echo $value['libelleEquipeR'];
                                echo "</option>";
                            }

                            if(isset($_GET["var1"])){
                                $equipeR2=$_GET["var1"];

                                foreach ($tabR2 as $key => $value ) {
                                    if($value['equipeRamasseurs']==$equipeR2) {
                                        echo  $value['libelleEquipeR'] . " selectionnée comme équipe 2."  ;
                                    }
                                }
                            }



                            echo" </select>";


                            ?>


                            <h6>Sélectionner les joueurs</h6>

                            <?php
                                  //Déclaration des variables pour joueurs facultatifs
                                  $joueurA2=null;
                                  $joueurB2=null;


                                  if($tournoi=='Tournoi simple'){
                                      //Joueur 1
                                      echo 'Joueur 1 : ';
                                      echo '<select onChange="getSelected(this);" name="joueurA1">';
                                      $tabJA1=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJA1 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      if(isset($_GET["var1"])){
                                         $joueurA1=$_GET["var1"];
                                         foreach ($tabJA1 as $key => $value ) {
                                             if($value['idjoueur']==$joueurA1) {
                                                 echo  $value['nomjoueur'] . " selectionné comme joueur 1."  ;
                                             }
                                         }
                                      }
                                      echo " </select>";
                                      echo "<br/>";

                                      //Joueur 2
                                      echo 'Joueur 2 : ';
                                      echo '<select onChange="getSelected(this);" name="joueurB1">';
                                      $tabJB1=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJB1 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      if(isset($_GET["var1"])){
                                         $joueurB1=$_GET["var1"];
                                         foreach ($tabJB1 as $key => $value ) {
                                             if($value['idjoueur']==$joueurB1) {
                                                 echo  $value['nomjoueur'] . " selectionné comme joueur 2."  ;
                                             }
                                         }
                                      }
                                      echo " </select>";
                                      echo "<br/>";


                                  }
                                  else{
                                    //Première équipe
                                      echo 'Joueurs équipe 1 : ';
                                      echo '<select onChange="getSelected(this);" name="joueurA1">';
                                      $tabJA1=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJA1 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      echo " </select>";
                                      echo " ";
                                      echo '<select onChange="getSelected(this);" name="joueurA2">';
                                      $tabJA2=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJA2 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      echo " </select>";
                                      echo "<br/>";

                                    //Deuxième équipe
                                      echo 'Joueurs équipe 2 : ';
                                      echo '<select onChange="getSelected(this);" name="joueurB1">';
                                      $tabJB1=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJB1 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      echo " </select>";
                                      echo " ";
                                      echo '<select onChange="getSelected(this);" name="joueurB2">';
                                      $tabJB2=$maConnexionBD->getJoueur();
                                      echo "<option value='' > " ;
                                      foreach ($tabJB2 as $key => $value ) {
                                         echo " <option value=".$value['idjoueur']." > ";
                                         echo $value['nomjoueur'];
                                         echo "</option>";
                                      }
                                      echo " </select>";
                                      echo "<br/>";

                                  }

                             ?>

                              <!-- Quand on sépare en 2 fichier on a 2 forulaires,
                              on est donc obligé de repasser les valeures dans le deuxieme form
                              via des valeures cachées comme ici:
                             -->
                            <input type="hidden" value="<?php echo $libelleMatch?>" name="libelleMatch">
                            <input type="hidden" value="<?php echo $dateMatch?>" name="dateMatch">
                            <input type="hidden" value="<?php echo $coefMatch?>" name="coefMatch">
                            <input type="hidden" value="<?php echo $courtMatch?>" name="courtMatch">
                            <input type="hidden" value="<?php echo $creneauMatch?>" name="creneauMatch">
                            <input type="hidden" value="<?php echo $tournoi?>" name="tournoi">
                            <input type="hidden" value="<?php echo $typeMatch?>" name="typeMatch">

                        <p>
                            <input type="submit" value="valider" name="validerM3">
                        </p>

                        <?php


                            if(isset($_POST['validerM3']))
                            {
                                // on re récupère le tout.
                                $libelleMatch= $_POST['libelleMatch'];
                                $dateMatch= $_POST['dateMatch'];
                                $coefMatch=$_POST['coefMatch'];
                                $courtMatch=$_POST['courtMatch'];
                                $creneauMatch=$_POST['creneauMatch'];
                                $tournoi=$_POST['tournoi'];
                                $typeMatch =$_POST['typeMatch'];

                                $equipeA=$_POST['arbitre'];
                                $equipeR1=$_POST['ramasseurs1'];
                                $equipeR2=$_POST['ramasseurs2'];
                                $joueurA1=$_POST['joueurA1'];
                                $joueurB1=$_POST['joueurB1'];

                                if($tournoi=='Tournoi simple'){
                                  $joueurA2=null;
                                  $joueurB2=null;
                                }
                                else {
                                  $joueurA2=$_POST['joueurA2'];
                                  $joueurB2=$_POST['joueurB2'];
                                }

                                 $maConnexionBD->ajoutMatch($libelleMatch,$dateMatch,$coefMatch,$courtMatch,$creneauMatch,$typeMatch,$tournoi,$equipeA,$equipeR1,$equipeR2,$joueurA1,$joueurA2,$joueurB1,$joueurB2);


                            }
                        ?>

                    </form>

                 </center>
             </div>
        </div>
    </div>
</body>
</html>
