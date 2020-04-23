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

            <h2  class = "texteaccueil">Passer une commande</h2>

            <form action="billeteriesuite.php" method="post">
                                     <center>
         <h6> choisissez un billet  :</h6>

   <table name= 'tableaudesalome' >
   <tr>
       <td id = "entete">Date</td>
       <td id = "entete">Match</td>
       <td id = "entete">A partir de </td>
       <td id ="entete">Choisissez votre billet</td>

        <?php
        $i=1;
        $tabE= $maConnexionBD->colonnedatebillet();
    
        foreach ($tabE as $key => $value) {
       echo "<tr><TD>$value[datematch]<br></TD>";
       echo "<TD>$value[libellematch]<br></TD>";
       echo "<td>bonjour</td>";
       echo "<td><center><input type=radio id='choix$i' name='select'
       value=$value[idmatch]></center></TD></tr>";
     //  "<td><center><input type=radio id='choix$i' name = 'select2' value = $value[datematch]></center></TD></tr>";
       $i++;
       // echo $value[0];
       }

       ?>
   </tr>

    </table>
        <input type="submit" value="Suivant" name="co" > </a>
        </center>
        </form>
           </body>
           </html>
