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
    </head>

    <body>
        <script type="text/javascript">


</script>
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
                                 <h6> Votre billet  :</h6>

                                 <?php
                                 echo"Id de votre billet :  ".$_SESSION['idmatchcommande'];
                                 echo "<br>";
                                 
                               //  echo "<br>";
                                 echo"Type de billet : ".$_SESSION['libelletbillet'];
                                 echo "<br>";

                                // echo "votre idtbillet est  : ".$_SESSION['idtbillet'];
                                 //echo "<br>";
                                 echo "Votre emplacement : " .$_SESSION['libelleemplacement'];
                                 echo "<br>";
                               //  echo "id du client connecté : ".$_SESSION['idclient'];

                                 /* Ces variables la on évitera de les afficher.
                                 Le soucis c'est que si l'utilisateur a rentré une fois un num licencié,
                                 il sera sauvegardé tant que la session est ouverte.

                                 echo" votre code promo est :".$_SESSION['libellepromo'];
                                 echo "<br>";
                                 echo"votre numéro de licencié est :".$_SESSION['numlicencie'];
                                 echo "<br>";
                                // echo "libellé de votre billet :  ".$_SESSION['libellematchcommande'];
                                 */

                                 ?>



                                 <output type = 'text' name = "billet">  </output> <br/>


                                  <p>
                                      <a href = panier.php>
                                     <input type="submit" value="paiement" name="co">
                                     </a>
                                 </p>
                                      </form>
                                     </center>

           </body>
           </html>
