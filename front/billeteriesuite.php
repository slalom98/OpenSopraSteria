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
        <link rel="stylesheet" href="../css/design.css"/>
        <script type="text/javascript" src="script.js"></script>
    </head>

    <body>

      <div class = "block3">
          <nav>
          <ul id = "menu"><!-- menu de navigation du site -->
             <li><img src="logosopra.png" width="70%" height="70%"> </li>
              <li><a href = "#"> Actualités </a> </li>
              <li> <a href = "#"> Billeterie </a></li>
              <li> <a href="#">Planning Match</a></li>
              <li> <a href="#">Résultats</a></li>
             <a href = "seconnecter.php"><button class="favorite styled" type="button"> Se Connecter </button></a>
             <a href = "sinscrire.php"><button class="favorite styled" type="button"> S'Inscrire </button></a>
             </ul></nav></div>



               <h2  class = "texteaccueil">Mon panier</h2>

                             <center>
                                 <form method="post" id="demoForm" class="demoForm">

                                     <h6>votre billet : </h6>
                                         <?php  if (isset($_POST['select'])){
                                             $_SESSION['idmatchcommande']=$_POST['select'];

                                         }

                                      //   echo "Votre billet :  ".$_SESSION['idmatchcommande'];

                                         $idmatch= $_SESSION['idmatchcommande'];



                                         ?>
                                    <?php
                                    $_SESSION['libellematch']= $maConnexionBD -> getlibellematch($_SESSION ['idmatchcommande']);
                                    echo "Votre match est : ".$_SESSION ['libellematch'];

                                    ?>


                                <h6>type de billet :  </h6>

                                 <select onChange="getSelected(this);" name="libelletbillet">

                                   <?php
                                   $tabE=$maConnexionBD->gettbillet2($idmatch);

                                   echo "<option value='' > " ;
                                   foreach ($tabE as $key => $value ) {
                                   echo "<option value=".$value['libelletbillet']."> ";

                                   echo $value['libelletbillet'];

                                   $_SESSION['libelletbillet']=$value['libelletbillet'];

                                   }
                                   ?>

                                   </select>

                          <!--       <div id="promo" style="display:none;" class="promo">
                          cette ligne permettra de cacher le champ, à afficher en Javascript ensuite quand un billet promo sera selectionné
                          -->
                                   <div id="promo" style="display: none;">
                                <h6>code promo  :  </h6>
                                     <input type = "text" name = "libelleP"> <br/>

                                  </div>

                                  <div id="licencie"  style="display: none;">
                                 <h6>Numéro de licence:  </h6>
                                     <input type = 'textarea' name = "numlicence" > <br/>

                                  </div>
                                </br>


                                  <h6> Votre emplacement :  </h6>

                                  <select onChange="getSelected(this);" name="libelleemplacement">
                                    <?php
                                      $tabE=$maConnexionBD->getEmplacements();
                                      echo "<option value='' > " ;
                                      foreach ($tabE as $key => $value ) {
                                          echo "<option value=".$value['libelleemplacement']."> ";
                                          echo $value['libelleemplacement'];
                                      }
                                    ?>
                                  </select>

                                  </br>
                                  </br>
                                  </br>
                                    <input type="submit" name = "valider" value = "Valider">
                                      </form>


                                     <?php
                                     // ici , fin de formulaire, on récupère tt ce qu'on veut récupérer
                                    if(isset($_POST['valider'])){


                                      $libelle=$_POST["libelletbillet"];

                                      if ($libelle=="licencie"){
                                        $numlicence = $_POST['numlicence'];
                                        $maConnexionBD->verifnumlicencie($numlicence);
                                        $_SESSION['numlicencie']=$numlicence;

                                      }

                                      if($libelle=="promo"){
                                       $libellepromo= $_POST['libelleP'];
                                       $maConnexionBD->verifpromo2($libellepromo);
                                       $_SESSION['libellepromo']=$libellepromo;
                                       $_SESSION['idpromo']= $maConnexionBD->getidpromo($_SESSION['libellepromo']);

                                      }


                                        $_SESSION['libelletbillet']= $libelle;
                                        $_SESSION['idtbillet'] = $maConnexionBD-> getidtbillet($libelle);
                                        $_SESSION['libelleemplacement'] = $_POST['libelleemplacement'];
                                        $_SESSION['idemplacement']=$maConnexionBD ->getidemplacement($_SESSION['libelleemplacement']);

                                    }


                                    ?>
                                  </br>
                                    <a href = billeteriechoixemplacement.php >
                                      <input type='button' value="Page suivante" name="co">
                                     </a>

                                  <p>
                                    </div>


                                     </a>
                             </center>
           </body>
           </html>
