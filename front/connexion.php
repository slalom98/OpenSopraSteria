session_start();
<?php
 include_once("ClasseConnexion.php");  
 
 $maConnexionBD = new Connection(); //nouvel objet connexion

 	
 
	if(isset($_REQUEST["co"])) 
	{
	    echo $login;
	    
		$login = $_REQUEST["login"];
		$pass = $_REQUEST["pass"];
		
		$maConnexionBD->connexion($login,$pass); 
		
		
		if ($login == "aurore.lpb@mail.com" && $pass == "filrouge")
			{echo "Bonjour Aurore LPB !";
			$maConnexionBD-> timelimit();    
			}
		else {echo "Combinaison e-mail/mot de passe incorrecte";}
		
		
	}
	
	
?>
