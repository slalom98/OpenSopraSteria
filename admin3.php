<?php session_start(); 
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
    var param=""; 
    var i=1;
        function getSelected(sel) {
             var idMatch = sel.options[sel.selectedIndex].value; // recupere le champ value de l'option (l'ID)
            // alert(sel.options[sel.selectedIndex].text); // récupere le texte stocké dans l'option 
            
             a=idMatch;
             window.location.href ="admin2.php?var1="+a;
        }
      
        
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

             <div class = "container">
                 <div class = "bloc1">
                     
                 </div>

                 <div class = "bloc22">
                     <div class = "titres">
                         <h2  class = "texteaccueil">Ajouter une liasse de Billets</h2>
                     </div>
                
                <div class = "inscription">

                    <center>
                      <form method="post" id="demoForm" class="demoForm">
                         <fieldset>
    
                 
                        
                    <p>
                    <input type="submit" value="valider" name="validerB">
                    </p>
                    <?php
                        if(isset($_POST['validerB'])) 
                        {
                            
                        }
                    ?>
                    </form>
                   
                
             
                 </center>
             </div>

<?php
                                
     //echo $idMatch; 
//     echo $_COOKIE['idmatch']; 
//marche pas en cookie
    
if(isset($_POST['validerB'])) 
{
    $idbillet= $_SESSION['idtbillet'];
    $idmatch= $_SESSION['idmatch'];
    //récuperer valeures des ID 
    $libelle=$_SESSION['libelle'];
    $quantite=$_SESSION['quantite'];
    
    
   echo  $idbillet;
  echo $idmatch;
   
    echo $libelle;
    echo $quantite;
 
     $maConnexionBD->ajoutBillet($idmatch,$idbillet,$quantite,$libelle);
       // fonction à faire

}
?>