<!-- Cette partie est à copier-coller dans le fichier admin.php-->

<!-- Mise en forme-->
<div class = "container">
  <div class = "bloc1">
  </div>

  <div class = "bloc22">
    <div class = "titres">
      <h2 class = "texteaccueil">Ajouter un joueur</h2>
    </div>

    <div class = "inscription">
      <center>
        <!-- Formulaire de saisie-->
        <form method="post">

          <h6>Indiquer le nom du joueur :</h6>
          <input type="text" name="nomjoueur" />
          <br />

          <h6>Indiquer le prénom du joueur :</h6>
          <input type="text" name="prenomjoueur" />
          <br />

          <h6>Indiquer la date de naissance du joueur :</h6>
          <input type="date" id="start" name="datenaissance"
          min="1900-01-01" max="2009-12-31">
          <br />

          <h6>Indiquer la nationalité du joueur :</h6>
          <input type="text" name="nationalite" />
          <br />

          <h6>Indiquer le classement ATP du joueur :</h6>
          <input type="text" name="classementATP" />
          <br />

          <br />
          <input type="submit" value="valider" name="validerJ" />
          <br />

        </form>
      </center>

      <!-- Récupération des variables et envoie à la fonction-->
      <?php

        if(isset($_POST['validerJ'])){
          $nom = $_REQUEST['nomjoueur'];
          $prenom = $_REQUEST['prenomjoueur'];
          $daten = $_REQUEST['datenaissance'];
          $pays = $_REQUEST['nationalite'];
          $atp = $_REQUEST['classementATP'];

          //Test
          //echo $nom." ".$prenom." "."<br />".$daten." ".$pays." ".$atp;

          //Fonction
          $maConnexionBD->ajoutJoueur($nom,$prenom,$daten,$pays,$atp);
        }
      ?>
    </div>
  </div>
</div>

<!-- Cette partie est à copier-coller dans le fichier ClasseConnexion.php-->
<?php
  public function ajoutJoueur($nom,$prenom,$daten,$pays,$atp){
    try{
      $sql = 'INSERT INTO `joueur` (`nomjoueur`,`prenomjoueur`,`datenaissance`,`nationalite`,`classementATP`)
              VALUES(:nomjoueur,:prenomjoueur,:datenaissance,:nationalite,:classementATP)';

      $req = $this->_bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

      $req->execute(array(':nomjoueur'=>$nom,':prenomjoueur'=>$prenom,':datenaissance'=>$daten,
      ':nationalite'=>$pays,':classementATP'=>$atp));

      echo '<body onLoad="alert(\'Joueur ajouté.\')">';
      echo '<meta http-equiv="refresh" content="0;URL=admin.php">';

    }
    catch(Exception $e){
      echo $e->getMessage();
      die();
    }
  }
?>
