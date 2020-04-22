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
             <div class = "container">
                 <div class = "bloc1">

                 </div>

                 <div class = "bloc22">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajouter un Match</h2>
                     </div>

                     <div class = "inscription">

                             <center>
                                  <form action="planning2.php" method="post" id="demoForm" class="demoForm">
                                     <fieldset>

                                    <h6>Selectionner le type de match :</h6>
                                    <select name="typeMatch">
                                        <option value="Tournoi">Tournoi   </option>
                                        <option value="Entrainement">Entrainement </option>
                                    </select>

                                    <h6>Selectionner le tournoi (entraînement non concerné):</h6>
                                    <select name="tournoi">
                                        <option value=""></option>
                                        <option value="Qualifications">Qualifications </option>
                                        <option value="Tournoi simple">Tournoi Simple </option>
                                        <option value="Tournoi double">Tournoi Double </option>
                                    </select>

                                    <h6>Indiquer l'affiche du match :</h6>
                                    <!--Libelle du match (écrire la phase [ex : Demi-finale], le tournoi et les joueurs participants -->
                                    <input type="text" name="libelleMatch"><br/>

                                    <h6>Indiquer le coefficient à appliquer au match :</h6>
                                    <input type="text" name="coefMatch"><br/>


                                       <h6>Sélectionner le créneau du match :</h6>
                                       <select name="creneauMatch">
                                           <option selected>Matin </option>
                                           <option>Midi </option>
                                           <option>Soirée</option>
                                       </select>


                                       <h6>Sélectionner la date du match :</h6>
                                       <input type="date" id="start" name="dateMatch"

                                       min="2020-01-01" max="2020-12-31"> <br/>

                                       <h6>Sélectionner le court :</h6>
                                       <select name="courtMatch">
                                           <option  value="Court central">Court central </option>
                                           <option value="Court 1">Court 1 </option>
                                           <option value="Court2">Court 22 </option>

                                       </select>


                                   <p>
                                   <input type="submit" value="valider" name="validerM2">
                                   </p>

                                </form>

                            <!--<?php
                             /*if(isset($_POST['validerM']))
                            	{
                            	    $dateM = $_REQUEST['dateM'];
                            	    $coeffM= $_REQUEST['coeffM'];
                            	    $libelleM= $_REQUEST['libelleM'];


                        	   	 //  $maConnexionBD->ajoutMatch($dateM,$coeffM,$libelleM);
                        	   	    // fonction à faire

                            	}*/
                            ?>-->


                             </center>
                         </div>
                     </div>
                 </div>
             </div>



              <div class = "container">
                 <div class = "bloc2">

                 </div>

                                  <div class = "bloc3">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Visualiser planning match</h2>
                     </div>

                    <?php
                       $tab= $maConnexionBD->afficherMatch();
                       foreach ($tab as $key => $value) {
                           echo "<tr><td>$value[dateMatch]<br></td>";
                           echo "<td>$value[libelleMatch]<br></td>";
                           echo "<td>$value[creneauMatch]<br></td>";
                           echo "</tr>";
                        }

                    ?>

                </div>


           </body>
           </html>
