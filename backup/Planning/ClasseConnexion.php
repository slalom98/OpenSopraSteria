<?php session_start();


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

            $sql = 'SELECT mailclient FROM `client` WHERE mailclient = :mail AND mdpclient = :mdp';

            $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $req ->execute(array(':mail' => $mail, ':mdp' => $mdpClient));

            $resultat = $req->fetchAll();

            $nb = count($resultat);

      if ($nb>0)  {
                 session_start();
                  // on enregistre les paramètres de notre visiteur comme variables de session (cookie)
                  // uniquement le mail pour des raisons de sécurité
                  $_SESSION['mail'] = $mail;

				  $_SESSION['connecte'] ="oui";

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
	}



	public function disconnect(){

	    session_destroy();
	    $this->_bdd =null;
	    die();

	}


	public function ajoutMatch($libelleMatch,$dateMatch,$coefMatch,$courtMatch,$creneauMatch,$typeMatch,$tournoi,$equipeA,$equipeR1,$equipeR2) {

        $sql = 'INSERT INTO `_match`(`libelleMatch`,`dateMatch`,`coeffMatch`,`courtMatch`,`creneauMatch`,`typeMatch`,`tournoi`,`equipeA`,`equipeR1`,`equipeR2`)
                VALUES(:libelleMatch,:dateMatch,:coefMatch,:courtMatch,:creneauMatch,:typeMatch,:tournoi,:equipeA,:equipeR1,:equipeR2)';



        $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        $req ->execute(array(':libelleMatch' => $libelleMatch, ':dateMatch' => $dateMatch,':coefMatch' => $coefMatch,':courtMatch' => $courtMatch,':creneauMatch' => $creneauMatch,':typeMatch' => $typeMatch,':tournoi' => $tournoi,':equipeA' => $equipeA,':equipeR1' => $equipeR1,':equipeR2' => $equipeR2));



        echo '<body onLoad="alert(\'ça a marché\')">';



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

}

 ?>
