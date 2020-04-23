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
    {
            $sql ='SELECT mdpclient from `client` where mailclient=:mail';
            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $req ->execute(array(':mail' => $mail));
            $resultat = $req->fetch(); // récupération du mdp

            if(isset($resultat[0])){
                    $verif= password_verify($mdpClient, $resultat[0]); // on décrypte le mot de passe
                    if($verif){
                      session_start(); // on démarre une session et stocke le mail du client
                      $_SESSION['mail'] = $mail;

                       $sql = 'SELECT idclient,mailclient FROM `client` WHERE mailclient = :mail';
                       $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                       $req ->execute(array(':mail' => $mail));
                       while ($donnees = $req->fetch())
                       {
                           $_SESSION['idclient']=$donnees['idclient'];
                       } // on stocke l'id du client.

                       echo ' <body onLoad="alert(\'Bienvenue! \')">   ';
                       echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';

                    }else{
                      echo '<body onLoad="alert(\'Mot de passe incorrect!\')">';
                    }

            }else{
                echo '<body onLoad="alert(\'Mail non reconnu!\')">';
            }

	}

	public function inscription($nom,$prenom,$telephone,$mail,$pass1)
    {
            $sql ='SELECT IDCLIENT from `client` where mailclient=:mail';
            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $req ->execute(array(':mail' => $mail));
            $resultat = $req->fetch(); // récupération du mdp

            if(isset($resultat[0])){
                  echo '<body onLoad="alert(\'Cette adresse mail est déja prise \')">';

            }else{
                $sql = 'INSERT INTO `client`(`NOMCLIENT`,`PRENOMCLIENT`,`TELCLIENT`,`MAILCLIENT`,`MDPCLIENT`)
                        VALUES(:nom,:prenom,:tel,:mail,:pass)';
                $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $req ->execute(array(':nom' => $nom, ':prenom' => $prenom,':tel' => $telephone,':mail' => $mail, ':pass' => $pass1));
                echo '<body onLoad="alert(\'Inscription réussie...\')">';
                echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
            }
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
         try{
            $sql = 'INSERT INTO `billet` (`idmatch`,`idtbillet`,`quantite`,`libellebillet`)
                    VALUES(:idmatch,:idbillet,:quantite,:libellebillet)';
            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req->execute(array(':idmatch'=>$idmatch,':idbillet'=>$idbillet,':quantite'=>$quantite,
            ':libellebillet'=>$libellebillet2));

         }catch(Exception $e){
             echo $e->getMessage();
             die();
         }
            echo '<body onLoad="alert(\'Ajout de billet OK ..\')">';
            echo '<meta http-equiv="refresh" content="0;URL=admin.php">';

	}

/* ancienne version
		public function ajoutMatch($dateM,$coeffM,$libelleM) {

            $sql = 'INSERT INTO `_match`(`dateMatch`,`coeffMatch`,`libelleMatch`)
                    VALUES(:datematch,:coeffmatch,:libellematch)';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':datematch' => $dateM, ':coeffmatch' => $coeffM,':libellematch' => $libelleM));

            echo '<body onLoad="alert(\'ajout OK ...\')">';


	} */

public function getlibellematch($idmatch){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT libellematch FROM `_match` WHERE idmatch =:idmatch';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':idmatch' => $idmatch));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['libellematch'];
    }

   return $resultat;
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

  public function getBilletByMatch($idmatch){

        $sql = 'SELECT idbillet FROM `billet` WHERE idmatch =:idmatch';
        $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $req ->execute(array(':idmatch' => $idmatch));
        while ($donnees = $req->fetch())
        {
            $resultat=$donnees['idbillet'];
        }
       return $resultat;
  }

	public function getEmplacements() {
//la fonction retourne un tableau d'emplacements
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

        $sql = 'SELECT idmatch,libellematch FROM `_match`';

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
      $sql = 'SELECT `idmatch`,`datematch`,`libellematch` FROM `_match` where inactif!=1  ';
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

/*public function prixtotalbillet ()

{
    $sql1 = 'SELECT prixtbillet FROM `tbillet` WHERE idtbillet = :idtbillet';
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
} */

public function getprixtbillet($idtbillet){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT prixtbillet FROM `tbillet` WHERE idtbillet =:idtbillet';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':idtbillet' => $idtbillet));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['prixtbillet'];
    }

   return $resultat;
}
public function getcoefmatch($idmatch){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT coeffMatch FROM `_match` WHERE idmatch =:idmatch';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':idmatch' => $idmatch));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['coeffMatch'];
    }

   return $resultat;
}
public function getcoeffpromo($idpromo){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT coeffpromo FROM `promo` WHERE idpromo =:idpromo';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':idpromo' => $idpromo));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['coeffpromo'];
    }

   return $resultat;
}

public function getcoeffemplacement($idemplacement){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT coeffemplacement FROM `emplacement` WHERE idemplacement =:idemplacement';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':idemplacement' => $idemplacement));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['coeffemplacement'];
    }
   return $resultat;
}

public function getidemplacement($libelleemplacement){
    // prend un libelle en parametre, on peut pas mettre de POST dans le fichier classe connexion

 //  $sql = 'SELECT idpromo FROM `promo` WHERE libellepromo = '.$_POST['libelleP'].'';

    $sql = 'SELECT idemplacement FROM `emplacement` WHERE libelleemplacement = :libelleemplacement';

    $req = $this->_bdd->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    $req ->execute(array(':libelleemplacement' => $libelleemplacement));

   /*
    $resultat = $req->fetchAll();

    return $resultat;
    */

    while ($donnees = $req->fetch())
    {
        $resultat=$donnees['idemplacement'];
    }
   return $resultat;
}


public function setQuantiteBillet($quantite,$idbillet){

    $sql = 'UPDATE `billet`
            SET `quantite` = :quantite
        WHERE idbillet= :idbillet ';


    $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $req ->execute(array(':quantite' => $quantite, ':idbillet' => $idbillet));
}

public function quantitemoins($idbillet){
    // fonctionne, baisse la quantite de 1.
    $sql = 'UPDATE `billet`
            SET `quantite` = quantite-1
        WHERE idbillet= :idbillet ';

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

public function ajoutCommande($idclient,$idemplacement,$idtbillet,$idpromo,$montant){

        $sql = 'INSERT INTO `commande`(`idclient`,`idemplacement`,`idtbillet`,`idpromo`,`montant`)
                VALUES(:idclient,:idemplacement,:idtbillet,:idpromo,:montant)';

        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req->execute(array(':idclient' => $idclient, ':idemplacement' => $idemplacement,
        ':idtbillet' => $idtbillet,':idpromo' => $idpromo,':montant' => $montant));


}

// partie planning


	public function ajoutMatch($libelleMatch,$dateMatch,$coefMatch,$courtMatch,$creneauMatch,$typeMatch,$tournoi,$equipeA,$equipeR1,$equipeR2,$joueurA1,$joueurA2,$joueurB1,$joueurB2) {

        $sql = 'INSERT INTO `_match`(`libelleMatch`,`dateMatch`,`coeffMatch`,`courtMatch`,`creneauMatch`,`typeMatch`,`tournoi`,`equipeA`,`equipeR1`,`equipeR2`,`joueurA1`,`joueurA2`,`joueurB1`,`joueurB2`)
                VALUES(:libelleMatch,:dateMatch,:coefMatch,:courtMatch,:creneauMatch,:typeMatch,:tournoi,:equipeA,:equipeR1,:equipeR2,:joueurA1,:joueurA2,:joueurB1,:joueurB2)';



        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':libelleMatch' => $libelleMatch, ':dateMatch' => $dateMatch,':coefMatch' => $coefMatch,':courtMatch' => $courtMatch,':creneauMatch' => $creneauMatch,
                             ':typeMatch' => $typeMatch,':tournoi' => $tournoi,':equipeA' => $equipeA,':equipeR1' => $equipeR1,':equipeR2' => $equipeR2,
                             ':joueurA1' => $joueurA1,':joueurA2' => $joueurA2,':joueurB1' => $joueurB1,':joueurB2' => $joueurB2));



        echo '<body onLoad="alert(\'Match ajouté\')">';
        echo '<meta http-equiv="refresh" content="0;URL=planning1.php">';


	}


	public function getArbitre() {


        $sql = 'SELECT `equipeA`.`equipeArbitre`,`equipeA`.`libelleEquipeA`
                FROM `equipeA`';

        $req = $this->_bdd->prepare($sql);

        $req ->execute();

        $resultat = $req->fetchAll();

		return $resultat;

	}

	public function getRamasseur() {


        $sql = 'SELECT `equipeR`.`equipeRamasseurs`,`equipeR`.`libelleEquipeR`
                FROM `equipeR`';

        $req = $this->_bdd->prepare($sql);

        $req ->execute();

        $resultat = $req->fetchAll();

		return $resultat;

	}

  public function getJoueur() {


        $sql = 'SELECT `joueur`.`idjoueur`,`joueur`.`nomjoueur`
                FROM `joueur`';

        $req = $this->_bdd->prepare($sql);

        $req ->execute();

        $resultat = $req->fetchAll();

		return $resultat;

	}

	public function afficherMatch() {

    $sql = '
             SELECT `idmatch`,`dateMatch`,`libelleMatch`,`creneauMatch`
             FROM `_match`
           ';

    $req = $this->_bdd->prepare($sql);
    $req->execute();
    $resultat = $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;

    }

    public function ajoutJoueur($nom,$prenom,$daten,$pays,$atp){
      try{
        $sql = 'INSERT INTO `joueur` (`nomjoueur`,`prenomjoueur`,`datenaissance`,`nationalite`,`classementATP`)
                VALUES(:nomjoueur,:prenomjoueur,:datenaissance,:nationalite,:classementATP)';

        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req->execute(array(':nomjoueur'=>$nom,':prenomjoueur'=>$prenom,':datenaissance'=>$daten,
        ':nationalite'=>$pays,':classementATP'=>$atp));

        echo '<body onLoad="alert(\'Joueur ajouté.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=joueur.php">';

      }
      catch(Exception $e){
        echo $e->getMessage();
        die();
      }
    }

    public function getTournoi($idmatch){
      $resultat=null;

      $sql = 'SELECT `_match`.`idmatch`,`_match`.`tournoi` FROM `_match` WHERE `_match`.`idmatch` = :idmatch';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idmatch'=>$idmatch));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idmatch']==$idmatch) {
            $resultat=$value['tournoi'];
        }
      }

      return $resultat;
    }

    public function getJoueurA1($idmatch){
      $resultat=null;

      $sql = 'SELECT `_match`.`idmatch`,`_match`.`joueurA1` FROM `_match` WHERE `_match`.`idmatch` = :idmatch';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idmatch'=>$idmatch));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idmatch']==$idmatch) {
            $resultat=$value['joueurA1'];
        }
      }

      return $resultat;
    }

    public function getJoueurA2($idmatch){
      $resultat=null;

      $sql = 'SELECT `_match`.`idmatch`,`_match`.`joueurA2` FROM `_match` WHERE `_match`.`idmatch` = :idmatch';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idmatch'=>$idmatch));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idmatch']==$idmatch) {
            $resultat=$value['joueurA2'];
        }
      }

      return $resultat;
    }

    public function getJoueurB1($idmatch){
      $resultat=null;

      $sql = 'SELECT `_match`.`idmatch`,`_match`.`joueurB1` FROM `_match` WHERE `_match`.`idmatch` = :idmatch';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idmatch'=>$idmatch));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idmatch']==$idmatch) {
            $resultat=$value['joueurB1'];
        }
      }

      return $resultat;
    }

    public function getJoueurB2($idmatch){
      $resultat=null;

      $sql = 'SELECT `_match`.`idmatch`,`_match`.`joueurB2` FROM `_match` WHERE `_match`.`idmatch` = :idmatch';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idmatch'=>$idmatch));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idmatch']==$idmatch) {
            $resultat=$value['joueurB2'];
        }
      }

      return $resultat;
    }

    public function getNomJoueur($j){

      $resultat=null;

      $sql = 'SELECT `joueur`.`idjoueur`,`joueur`.`nomjoueur` FROM `joueur` WHERE `joueur`.`idjoueur` LIKE :idjoueur ';

      $req = $this->_bdd->prepare($sql);
      $req ->execute(array(':idjoueur'=>$j));
      $restab = $req->fetchAll();
      foreach ($restab as $key => $value){
        if($value['idjoueur']==$j) {
            $resultat=$value['nomjoueur'];
        }
      }

      return $resultat;
    }

    public function ajoutScore($idmatch,$joueurA1,$joueurB1,$joueurA2,$joueurB2,
                    $Aset1,$Bset1,$Aset2,$Bset2,$Aset3,$Bset3){
      try{

        //JoueurA1 SET 1
        $sql = 'INSERT INTO `score` (`idmatch`,`idjoueur`,`numeroset`,`nbjeux`)
                VALUES(:idmatch,:idjoueur,:numeroset,:nbjeux)';
        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $req->execute(array(':idmatch'=>$idmatch,':idjoueur'=>$idjoueur,':numeroset'=>1,':nbjeux'=>$Aset1);






        echo '<body onLoad="alert(\'Le score pour ce match a bien été ajouté.\')">';
        echo '<meta http-equiv="refresh" content="0;URL=score.php">';

      }
      catch(Exception $e){
        echo $e->getMessage();
        die();
      }
    }

}

 ?>
