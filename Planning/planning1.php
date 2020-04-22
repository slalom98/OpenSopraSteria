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
             <!--<a href = "seconnecter.php"><button class="favorite styled" type="button"> Se Connecter </button></a>
             <a href = "sinscrire.php"><button class="favorite styled" type="button"> S'Inscrire </button></a>-->
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
                                        <option value="tournoi 2 ">Tournoi bis </option>
                                        <option value="Tournois 3 ">Tournoi final </option>
                                    </select>

                                    <h6>Selectionner le tournoi (entraînement non concerné):</h6>
                                    <select name="tournoi">

                                        <option value="Qualif">Qualifications </option>
                                        <option value="Tournoi simple">Tournoi Simple </option>
                                        <option value="Tournoi Double">Tournoi Double </option>
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
