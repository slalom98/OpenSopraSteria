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

                              <!-- Quand on sépare en 2 fichier on a 2 forulaires,
                              on est donc obligé de repasser les valeures dans le deuxieme form
                              via des valeures cachées comme ici:
                             -->
                            <input type="hidden" value="<?php echo $libelleMatch?>" name="libelleMatch">;
                            <input type="hidden" value="<?php echo $dateMatch?>" name="dateMatch">;
                            <input type="hidden" value="<?php echo $coefMatch?>" name="coefMatch">;
                            <input type="hidden" value="<?php echo $courtMatch?>" name="courtMatch">;
                            <input type="hidden" value="<?php echo $creneauMatch?>" name="creneauMatch">;
                            <input type="hidden" value="<?php echo $tournoi?>" name="tournoi">;
                            <input type="hidden" value="<?php echo $typeMatch?>" name="typeMatch">;

                        <p>
                            <input type="submit" value="valider" name="validerM3">
                        </p>

                        <?php

                        //$maConnexionBD->ajoutMatch("oui","2020-04-09",0.4,"cour","cren","tmatch",
                      //  "tournoi",1,1,2); // ici votre fonction ajout fonctionne très Bienvenue
                        // c'est juste que vous arrivez pas à récupérer les valeures

                        //echo $equipeA.  $equipeR1.$equipeR2; ca affiche rien ca!
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
                                $equipeR2=$_POST['ramasseurs2'];
                                $equipeR1=$_POST['ramasseurs2'];


                                 $maConnexionBD->ajoutMatch($libelleMatch,$dateMatch,$coefMatch,$courtMatch,$creneauMatch,$typeMatch,$tournoi,$equipeA,$equipeR1,$equipeR2);


                            }
                        ?>

                    </form>

                 </center>
             </div>
        </div>
    </div>
</body>
</html>
