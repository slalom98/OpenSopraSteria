<?php
    include_once("ClasseConnexion.php"); 
	// equivalent du import en Java.. on importe notre classe Connexion 
	
	
    $aj = new Connection(); //connexion à la BDD
	
	// petit test en local 
 	$pseudo = 'oui';
	$mdp = 'oui'; 
	
	
	$aj->connexion($pseudo,$mdp); // on utilise notre fonction connexion sur notre objet BDD 

    ?>