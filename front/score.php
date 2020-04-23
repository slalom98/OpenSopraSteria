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

         <div class = "container">
           <div class = "bloc1">
           </div>

           <div class = "bloc22">
             <div class = "titres">
               <h2 class = "texteaccueil">Renseigner un score</h2>
             </div>

             <div class = "inscription">
               <center>
                 <form action ="score2.php" method="post">
                   <!-- Sélection du match -->
                   <h6>Sélectionner le match :</h6>
                   <select onChange="getSelected(this);" name="idmatch">
                     <?php
                        $tab=$maConnexionBD->getMatchs();
                        echo "<option value='' > " ;
                        foreach ($tab as $key => $value ) {
                             echo " <option value=".$value['idmatch']." > ";
                             echo $value['libellematch'];
                             echo "</option>";
                        }
                     ?>
                   </select>
                   <br/><br/>
                   <!-- Confirmation du match -->
                   <?php
                     if(isset($_GET["var1"])){
                         $idmatch=$_GET["var1"];
                         foreach ($tabE as $key => $value ) {
                             $estjoue = $maConnexionBD->getEstJoue($idmatch);
                             if($value['idmatch']==$idmatch && $estjoue !=1) {
                                 echo  'Souhaitez-vous enregistrer le score
                                        relatif au match suivant : '.$value['libellematch'].' ?<br/>' ;
                                 echo '<input type="submit" value="confirmer" name="valider">';
                             }
                             else{
                               if($value['idmatch']==$idmatch && $estjoue !=0){
                                 echo 'Ce match a déjé été joué. Impossible de remplir les scores à nouveau';
                               }
                             }
                         }
                     }
                   ?>
                 </form>
               </center>
             </div>
           </div>

     </div>
 </body>
</html>
