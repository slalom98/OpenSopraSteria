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
                                 <form action = "billeteriechoixemplacement.php" method="post">

                                     <h6>votre billet : </h6>
                                         <?php  if (isset($_POST['select'])){
                                             $_SESSION['idmatchcommande']=$_POST['select'];

                                         }

                                         echo "Votre billet :  ".$_SESSION['idmatchcommande'];
                                         
                                         $idmatch= $_SESSION['idmatchcommande'];

                                         ?>

                                <h6>type de billet :  </h6>

                                 <select onChange="getSelected(this);" name="libelletbillet">

                                     <?php
                                   $tabE=$maConnexionBD->gettbillet2($idmatch);

                                   echo "<option value='' > " ;
                                   foreach ($tabE as $key => $value ) {
                                   echo "<option value=".$value['libelletbillet']."> ";

                                   echo $value['libelletbillet'];
                                   }
                                   ?>

                                   </select>

                                   <?php
                                   if(isset($_GET["var1"])){
                                    $libelletbillet=$_GET["var1"] ;

                                        foreach ($tabE as $key => $value ) {

                                            if($value['libelletbillet']==$libelletbillet) {
                                            echo"vous avez choisis :  ".$value['libelletbillet'];
                                            }
                                        }

                                     $_SESSION['libelletbillet'] = $_GET["var1"];






                                   }



                                     ?>
                                      <?php

                                    $_SESSION['idtbillet'] = $maConnexionBD-> getidtbillet($_SESSION['libelletbillet']);
                                    //la fonction renvoie l'ID.
                                    if (isset($_GET["var1"])){
                                    echo $_SESSION['idtbillet'];}

                                    ?>

                                     </form>

                              <form action = "billeteriesuite.php" method="post">

                          <!--       <div id="promo" style="display:none;" class="promo">
                          cette ligne permettra de cacher le champ, à afficher en Javascript ensuite quand un billet promo sera selectionné
                          -->
                                   <div id="promo">
                                <h6>code promo  :  </h6>
                                     <input type = "text" name = "libelleP"> <br/>
                                     <input type = "submit" name = "check" value = "ok"  >

                                     <?php
                                     if(isset($_POST['check'])){
                                      $libellepromo= $_REQUEST['libelleP'];
                                      // $maConnexionBD->verifiercodepromo($libellepromo);
                                        $maConnexionBD->verifpromo2($libellepromo);
                                        $_SESSION['libellepromo']=$_POST['libelleP'];
                                        if(isset($_POST['libelleP']))
                                        {echo$_SESSION['libellepromo'];
                                     } }
                                     ?>

                                     <?php
                                    $_SESSION['idpromo'] = $maConnexionBD-> getidpromo($_SESSION['libellepromo']);
                                    //la fonction renvoie l'ID.
                                    if (isset($_POST['libelleP'])){
                                    echo $_SESSION['idpromo'];}
                                    ?>

                                  </div>

                                 <h6>Numéro de licence:  </h6>
                                     <input type = 'textarea' name = "numlicence" > <br/>
                                     <input type = "submit" name = "valider" value = "ok"  >
                                      <?php

                                     if(isset($_POST['valider'])){
                                    $numlicence = $_REQUEST['numlicence'];
                                    $maConnexionBD->verifnumlicencie($numlicence);
                                     $_SESSION['numlicencie']=$_POST['numlicence'];
                                   if(isset($_POST['numlicence']))
                                   { echo$_SESSION['numlicencie'];}

                                    }?>
                                     <?php

                                    $_SESSION['idclient'] = $maConnexionBD-> getidclient($_SESSION['numlicencie']);
                                    //la fonction renvoie l'ID.
                                    if (isset($_POST['numlicence'])){
                                    echo $_SESSION['idclient'];


                                    }

                                    ?>
                                  <p>
                                    </form>
                                    <a href = billeteriechoixemplacement.php >
                                      <input type='button' value="suivant" name="co">
                                     </a>
                             </center>
           </body>
           </html>
