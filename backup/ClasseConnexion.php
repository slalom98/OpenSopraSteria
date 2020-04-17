<?php


class Connection
{
    private $nomServeur;
	private $utilisateur;
	private $mdp; //
	private $nomBD; //


    public function __construct()
    {

        try {
            $this->_nomServeur   = "localhost"; // on est sur le serveur donc il sait ou il est
            $this->_utilisateur     = "root"; // utilisateur par defaut
            $this->_mdp = "";
            $this->_nomBD   = "tennis";
            $this->_bdd      = new PDO('mysql:host=' . $this->_nomServeur . ';dbname=' . $this->_nomBD . ';charset=utf8', $this->_utilisateur, $this->_mdp);
            return $this->_bdd;
        }
        catch (Exception $e) {
            die('Erreur de connexion à la BDD:' . $e->getMessage());
        }
    }


    public function connexion($mail,$mdpClient)
    {       	/*

			$req = $this->_bdd->prepare("SELECT * FROM `client` WHERE `mailclient` = '".$mail."' AND `mdpClient` = '".$mdpClient."' ");

			//version safe
		   //$query = $this->_bdd->prepare("SELECT * FROM client WHERE `mailclient`='".$mail."' AND `mdpClient`='".md5($mdpClient)."' ");
           $req->execute();
            $resultat =$req->fetchall();
           */

            $sql = 'SELECT idclient,mailclient FROM `client` WHERE mailclient = :mail AND mdpclient = :mdp';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':mail' => $mail, ':mdp' => $mdpClient));

            $resultat = $req->fetchAll();

            $nb = count($resultat);

      if ($nb>0)  {
                 session_start();
                  // on enregistre les paramètres de notre visiteur comme variables de session (cookie)
                  // uniquement le mail pour des raisons de sécurité
                  $_SESSION['mail'] = $mail;

                  while ($donnees = $req->fetch())
                  {
                      $_SESSION['idclient']=$donnees['idclient'];
                  }
                  var_dump($_SESSION);

				  //version sécurisée
                  //$_SESSION['pwd'] = md5($mdp);

                 // on redirige notre visiteur vers la page d'acceuil avec un message
                  echo ' <body onLoad="alert(\'Bienvenue .....\')">   ';
                  echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';

            }
      else
            {
                  // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un message d'erreur en javascript
                 echo '<body onLoad="alert(\'Utilisateur non reconnu...\')">';
                  // puis on le redirige vers la page de connexion
                  echo '<meta http-equiv="refresh" content="0;URL=seconnecter.php">';



            }

            $sql = 'SELECT idclient,mailclient FROM `client` WHERE mailclient = :mail AND mdpclient = :mdp';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':mail' => $mail, ':mdp' => $mdpClient));


            while ($donnees = $req->fetch())
            {
                $_SESSION['idclient']=$donnees['idclient'];
            }
	}

	public function inscription($nom,$prenom,$telephone,$mail,$pass1)
    {

            $sql = 'INSERT INTO `client`(`NOMCLIENT`,`PRENOMCLIENT`,`TELCLIENT`,`MAILCLIENT`,`MDPCLIENT`)
                    VALUES(:nom,:prenom,:tel,:mail,:pass)';



            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':nom' => $nom, ':prenom' => $prenom,':tel' => $telephone,':mail' => $mail, ':pass' => $pass1));

            //$resultat = $req->fetchAll();


            echo '<body onLoad="alert(\'Inscription réussie...\')">';
            echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';


	}

	public function disconnect(){

	    session_destroy();
	    $this->_bdd =null;
	    die();

	}


	/* ancienne fonction aout billet
	public function ajoutBillet($libelle,$prix,$quantite,$idclient,$idmatch,$idemplacement,$idpromo)
    {
        // incomplet, devra ajouter aussi les clefs secondaire en fonction du choix utilisateur

            $sql = 'INSERT INTO `billet`(`LIBELLEBILLET`,`prix`,`quantite`,`idmatch`,`idemplacement`,`idpromo`)
                    VALUES(:libellebillet,:prix,:quantite,:idmatch,:idemplacement,:idpromo)';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':libellebillet' => $libelle, ':prix' => $prix,':quantite' => $quantite,':idmatch' =>$idmatch,':idemplacement' =>$idemplacement,':idpromo' =>$idpromo ));


            echo '<body onLoad="alert(\'Ajout OK ..\')">';
            echo '<meta http-equiv="refresh" content="0;URL=admin.php">';


	} */
  public function getidtbillet($libelle){
	        $sql = 'SELECT idtbillet FROM `tbillet` WHERE libelletbillet =:libelle';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':libelle' => $libelle));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['idtbillet'];
    }

   return $resultat;

	}

		public function ajoutBillet($idmatch,$idbillet,$quantite,$libellebillet2)
    {
        // incomplet, devra ajouter aussi les clefs secondaire en fonction du choix utilisateur
         try{

            $sql = 'INSERT INTO `billet` (`idmatch`,`idtbillet`,`quantite`,`libellebillet`)
                    VALUES(:idmatch,:idbillet,:quantite,:libellebillet)';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req->execute(array(':idmatch'=>$idmatch,':idbillet'=>$idbillet,':quantite'=>$quantite,':libellebillet'=>$libellebillet2));

         }catch(Exception $e){

             echo $e->getMessage();
             die();
         }

            echo '<body onLoad="alert(\'Ajout OK ..\')">';
            echo '<meta http-equiv="refresh" content="0;URL=admin.php">';


	}

		public function ajoutMatch($dateM,$coeffM,$libelleM) {

            $sql = 'INSERT INTO `_match`(`dateMatch`,`coeffMatch`,`libelleMatch`)
                    VALUES(:datematch,:coeffmatch,:libellematch)';



            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':datematch' => $dateM, ':coeffmatch' => $coeffM,':libellematch' => $libelleM));



            echo '<body onLoad="alert(\'ajout OK ...\')">';


	}



	/*
	public function getMatchs()
    {

        //la fonction retournera un tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT `_match`.`libelleMatch`,`_match`.`datematch`,`billet`.`quantite` AS nbBillets
                FROM `_match`
                INNER JOIN `billet` ON `_match`.`idmatch`=`billet`.`idmatch`
                WHERE DATEDIFF(`_match`.`datematch`,getdate())>0';

        $req = $this->_bdd->prepare($sql);

        $req ->execute();

        $resultat = $req->fetchAll();

		return $resultat;

	} */

	public function getBillets() {

        //la fonction retournera un tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT `_match`.`libelleMatch`,`_match`.`datematch`,`billet`.`quantite` AS nbBillets
                FROM `_match`
                INNER JOIN `billet` ON `_match`.`idmatch`=`billet`.`idmatch`
                WHERE DATEDIFF(`_match`.`datematch`,getdate())>0';

        $req = $this->_bdd->prepare($sql);

        $req ->execute();

        $resultat = $req->fetchAll();

		return $resultat;

	}
	public function getIdBillets() {

        //la fonction retournera un tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT idbillet,libellebillet
                FROM `billet`';

        $req = $this->_bdd->prepare($sql);

        $req->execute();

         $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // pour retourner sous forme de tableau associatif

		return $resultat;

	}
	public function supprimerBillets($idbillet) {

        $sql = 'DELETE FROM `billet` WHERE idbillet = :idbillet';

        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':idbillet' => $idbillet));

        echo '<body onLoad="alert(\'Billets supprimés\')">';


	}

	public function getEmplacements() {

        //la fonction retournera un tableau de tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT idemplacement,libelleemplacement FROM `emplacement` ';

        $req = $this->_bdd->prepare($sql);

        $req->execute();

         $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // pour retourner sous forme de tableau associatif

		return $resultat;


	}

		public function gettbillet() {

        //la fonction retournera un tableau de tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT idtbillet,libelletbillet,prixtbillet FROM `tbillet` ';

        $req = $this->_bdd->prepare($sql);

        $req->execute();

         $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // pour retourner sous forme de tableau associatif

		return $resultat;


	}


	public function gettbillet2($idmatch){
	   // prend en parametre l'id du match pour recupérer les types de billets qui lui correspondent.
	   $sql='SELECT libelletbillet from `tbillet` WHERE idtbillet in
	   (select idtbillet from `billet` where idmatch =:idmatch)
	   ';


	    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':idmatch' => $idmatch));

	    $resultat = $req -> fetchAll(PDO::FETCH_ASSOC);
	    return $resultat;
	}


	/*
	public function gettbillet2($idmatch){

	   $sql='SELECT DISTINCT billet3.idtbillet, libelletbillet from `billet3` INNER JOIN `tbillet`ON `billet3`.idtbillet = `tbillet`.idtbillet
	   where billet3.idmatch=:idmatch
	   ' ;


         $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':idmatch' => $idmatch));

	    $resultat = $req -> fetchAll(PDO::FETCH_ASSOC);
	    return $resultat;
	} */

	public function getPromos() {

        //la fonction retournera un tableau de tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT idpromo,libellepromo FROM `promo` ';

        $req = $this->_bdd->prepare($sql);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // pour retourner sous forme de tableau associatif

		return $resultat;

	}

	public function getMatchs() {

        //la fonction retournera un tableau de tableau de match, idéalement on virera les valeurs ou la date est antérieur à la date du jour pour éviter l'ajout de billet sur un match deja passé.

        $sql = 'SELECT idmatch,libellematch FROM `_match` ';

        $req = $this->_bdd->prepare($sql);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // pour retourner sous forme de tableau associatif

		return $resultat;

	}

		public function ajoutEmplacement($libelleE,$coeffE){

        $sql = 'INSERT INTO `emplacement`(`libelleemplacement`,`coeffemplacement`)
                VALUES(:libelle,:coeff)';

        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':libelle' => $libelleE, ':coeff' => $coeffE));

        echo '<body onLoad="alert(\'ajout OK ...\')">';


	}

    public function ajoutcodepromo( $libelleP,$coeffP){

        $sql = 'INSERT INTO `promo`(`libellepromo`,`coeffpromo`)
                VALUES(:libelle,:coeff)';

        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':libelle' => $libelleP, ':coeff' => $coeffP));


    }
    public function colonnedatebillet () {
     $sql = 'SELECT `idmatch`,`datematch`,`libellematch` FROM `_match`';
     //INNER JOIN `billet` ON `billet`.`libellematch` = `_match`.`libellematch` ;
       $req = $this->_bdd->prepare($sql);
       $req->execute();
       $resultat = $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
       return $resultat;

       }

public function verifpromo2($libellepromo)
    {
            $sql = 'SELECT  libellepromo FROM `promo` WHERE libellepromo = :libellepromo';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':libellepromo' => $libellepromo ));

            $resultat = $req->fetchAll();

            $nb = count($resultat);

      if ($nb>0)  {

                  //$_SESSION['libellepromo'] = $libellepromo;

                 // on redirige notre visiteur vers la page d'acceuil avec un message
                  echo ' <body onLoad="alert(\'Code promo OK .....\')">   ';

                 // echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';

            }
      else
            {
                 echo '<body onLoad="alert(\'Code promo non reconnu...\')">';
                  // puis on le redirige vers la page de connexion
               //   echo '<meta http-equiv="refresh" content="0;URL=seconnecter.php">';


            }


	}

public function getidpromo($libelle){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo =:libelle';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':libelle' => $libelle));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['idpromo'];
    }

   return $resultat;
}


function verifnumlicencie($numlicence){
      $sql = 'SELECT idlicence FROM `licence` WHERE numlicencie = :numlicence';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':numlicence' => $numlicence));

            $resultat = $req->fetchAll();

            $nb = count($resultat);

      if ($nb>0)  {

                  //$_SESSION['libellepromo'] = $libellepromo;

                 // on redirige notre visiteur vers la page d'acceuil avec un message
                  echo ' <body onLoad="alert(\'Numéro licencié correct\')">   ';
                 // echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';

            }
      else
            {
                 echo '<body onLoad="alert(\'Numéro licencié non reconnu...\')">';
                  // puis on le redirige vers la page de connexion
               //   echo '<meta http-equiv="refresh" content="0;URL=seconnecter.php">';


            }

}

public function getidclient($numlicence){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT idclient FROM `client` WHERE numerolicence = :numlicence';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':numlicence' => $numlicence));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['idclient'];
    }

   return $resultat;

}

public function prixtotalbillet ()

{
    $sql1 = 'SELECT `prix` FROM `billet`';
    $prix = $this->_bdd->prepare($sql1);
    $prix ->execute();
    //  $sql2= 'SELECT `coeffemplacement FROM `billet`INNER JOIN emplacement ON `emplacement`.`idemplacement`= `billet.idemplacement`';

    $coeffemplacement = $this -> _bdd ->prepare($sql2);
    $coeffemplacement ->execute();
    $sql3 = 'SELECT `coeffpromo` FROM `billet` INNER JOIN `promo`ON `promo`.`idpromo`= `billet`.`idpromo`';
    $coeffpromo = $this->_bdd->prepare($sql3);
    $coeffpromo ->execute();
    $sql4 = 'SELECT `coeffmatch`FROM `billet`INNER JOIN `_match`ON `_match`.`idmatch` = `billet`.`idmatch`';
    $coeffmatch = $this->_bdd->prepare($sql4);
    $coeffmatch ->execute();

    $calcultotal = $prix*$coeffemplacement*$coeffpromo*$coeffmatch;

    echo "($calcultotal) €";
}

public function setQuantiteBillet($quantite,$idbillet){

    $sql = 'UPDATE `billet2`
            SET `quantite` = :quantite
        WHERE idbillet2= :idbillet ';


    $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $req ->execute(array(':quantite' => $quantite, ':idbillet' => $idbillet));
}

public function quantitemoins($idbillet){
    // fonctionne, baisse la quantite de 1.
    $sql = 'UPDATE `billet2`
            SET `quantite` = quantite-1
        WHERE idbillet2= :idbillet ';

    $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $req ->execute(array(':idbillet' => $idbillet));
}


public function timelimit() {

    set_time_limit(20);
    if ($i<20){

    echo "blablabla : $i";
    $i++;}
    else {
        $this->_bdd -> disconnect();
    }


}
}

 ?>
