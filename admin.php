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
             
             //alert(idEmplacement);

             a=idMatch;
             //window.location.href = "admin.php?var1=" + a;

            // window.location.href = "admin.php?var1=" + a + "&var2=" + b + "&var3=" + c ;
             //window.location.href = "admin.php?var1=" + a;
           // setParam(a);
             // bon la fonction prend les memes valeurs pour les 3, faudrait faire 3 fonctions je pense
             
             
              window.location.href ="admin.php?var1="+a;
        }
        /*
        function getSelectedE(sel){
            var idEmplacement = sel.options[sel.selectedIndex].value; 
            b=idEmplacement;
          //  window.location.href = "admin.php?var2=" + b;
            setParam(b);
        }
        
        function getSelectedP(sel){
            var idPromo = sel.options[sel.selectedIndex].value; 
            c=idPromo;
            //window.location.href = "admin.php?var3=" + c;
            setParam(c);

        }
   
        function setParam(id){
            param = param + "var"+i+"="+id;
            alert(param);
            i++;
            window.location.href ="admin.php?"+param

        }
        */
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
                                  <form action="admin2.php" method="post" id="demoForm" class="demoForm">
                                     <fieldset>
                                     <!-- ici on fera plutot des listes déroulantes pour ces deux champs ou on selectionne les objets présents en BD --> 
                                    <h6>Selectionner le match :</h6>
                                    
                                    <select onChange="getSelected(this);" name="idmatch"> 
                                    <?php
                                  
                                   $tabE=$maConnexionBD->getMatchs();
                                    // tabE est un tableau de tableau 
                                
                                    // var_dump($tabE); // pour tester le résultat
                                    echo "<option value='' > " ; // première ligne vide pour afficher rien au chargement de la page
                                    foreach ($tabE as $key => $value ) {
                                        // il faudra donner un nom au select
                                        echo " <option value=".$value['idmatch']." > ";
                                        echo $value['libellematch'];
                                        //  si je veux afficher qu'une colonne d'un tuple je parcours le premier tableau avec la clef. 
                                        echo "</option>";
                                    } 
                                    
                                 //   $maConnexionBD->setQuantiteBillet(45,1); test fonction
                              
                                       
                                    ?>
                                    </select> 
                                     
                                    <?php
                                    /*  affiche le match selectionné. */ 
                                    if(isset($_GET["var1"])){
                                        $idMatch=$_GET["var1"]; 
                                        
                                        foreach ($tabE as $key => $value ) {
                                            if($value['idmatch']==$idMatch) {
                                                echo  $value['libellematch'] . " selectionné"  ;
                                            }
                                        }
                                    }
                                    
                                    /* stockage de l'id match en session. */ 
                                    if(isset($_GET["var1"])){
                                            
                                         $idMatch=$_GET["var1"];  // récupere l'idMatch dans l'URL 
                                         $_SESSION['idmatch'] = $idMatch; // stocke l'idMatch en variable de session
                                    }
                                    ?>
                                    
                                    
                                    
                                    
                                    <h6> Libelle :</h6>
                                    <input type="text" name="libelleB"><br/>
                                    <h6>Quantite voulue</h6>
                                    <input type="text" name="quantiteB"><br/>
                                    
                                <p>
                                <input type="submit" value="valider" name="validerB">
                                </p>
                                
                                </form>
                             
                                    
                            
                         
                             </center>
                         </div>
                     </div>
                 </div>
             </div>
             
             
             <div class = "container">
                 <div class = "bloc2">
                     
                 </div>

               
                            
                             </center>
                         </div>
                     </div>
                 </div>
             </div>
             
             
             
             
           </body>
           </html>
