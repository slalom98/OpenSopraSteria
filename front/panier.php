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
                                 <h6> Votre billet :</h6>
                                 <br>
                                 <?php
                                 echo"Votre Idbillet : ".$_SESSION['idmatchcommande'];
                                 echo "<br>";
                                 echo "Votre match :".$_SESSION['libellematch'];
                                 echo "<br>";
                                 echo"Votre type de billet :".$_SESSION['libelletbillet'];
                                 echo "<br>";
                                 echo "Votre emplacement : ".$_SESSION ['libelleemplacement']?>
<br>
                                 <h6> Prix total : </h6>



                                     <?php

                                  $_SESSION['prixtbillet']=$maConnexionBD ->getprixtbillet($_SESSION['idtbillet']);
                                  echo"votre billet de base est au prix de : ".$_SESSION['prixtbillet']."€";
                                  echo"<br>";

                                  $_SESSION['coefmatch']=$maConnexionBD ->getcoefmatch($_SESSION['idmatchcommande']);


                                  $_SESSION['coeffpromo']=$maConnexionBD ->getcoeffpromo($_SESSION['idpromo']);


                                  $_SESSION['coeffemplacement']=$maConnexionBD ->getcoeffemplacement($_SESSION['idemplacement']);


                                 $ajoutprixtotal = $_SESSION['prixtbillet']*$_SESSION['coefmatch']*$_SESSION['coeffemplacement'];
                                 if ($_SESSION['libelletbillet']=='promo'){
                                     $totalpromo =$_SESSION['prixtbillet']*$_SESSION['coeffpromo'];

                                 $prixtotal = $_SESSION['prixtbillet']+$ajoutprixtotal-$totalpromo;
                                 }

                                 else{

                                 $prixtotal = $_SESSION['prixtbillet']+$ajoutprixtotal;}

                                 echo "votre billet après réduction est au prix de : " .$prixtotal."€";

                                $_SESSION['prixtotal']=$prixtotal;

                                  ?>
                                <input type="hidden" value="<?php echo $prixtotal?>" name="prixtotal">;

                                 <output type = 'text' name = "billet">  </output> <br/>


                                  <p>
                                     <input type="submit" value="suivant" name="co">
                                 </p>
                                      </form>
                                    </center>

                                  <?php
                                      $montant = $_SESSION['prixtotal'];

                                      $idclient= $_SESSION['idclient'];
                                      $idemplacement=$_SESSION['idemplacement'];
                                      $idpromo=$_SESSION['idpromo'];
                                      $idtbillet=$maConnexionBD->getidtbillet($_SESSION['libelletbillet']);

                                      $maConnexionBD->ajoutCommande($idclient,$idemplacement,$idtbillet,$idpromo,$montant);


                                      $idbillet=$maConnexionBD->getBilletByMatch($_SESSION['idmatchcommande']);

                                      $maConnexionBD->quantitemoins($idbillet);

                                      // récuperer idbillet
                                  ?>

                                  <a href ="billet.php" >
                                    <input type='button' value="Imprimer billet" name="pdf">
                                   </a>

           </body>
           </html>
