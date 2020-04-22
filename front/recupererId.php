<!DOCTYPE html>
<html>
    <head>
        <title>Open Sopra Steria | Récupération </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="design.css"/>
    </head>

    <body>
      <div class = "block3">
          <nav>
          <ul id = "menu"><!-- menu de navigation du site -->
             <li><img src="logosopra.png" width="50%" height="50%"> </li>
              <li><a href = "#"> Actualités </a> </li>
              <li> <a href = "#">  Billeterie </a></li>
              <li> <a href="#">Planning Match</a></li>
              <li> <a href="#">Résultats</a></li>
             <a href = "seconnecter.html"><button class="favorite styled" type="button"> Se Connecter </button></a></input>
             <a href = "sincrire.html"><button class="favorite styled" type="button"> S'Inscrire </button></a></input>
             </ul></nav></div>


        <div class = "container">
            <div class = "bloc1">
                <img class = "raquette" src = "raquette.png">
            </div>

            <div class = "bloc2">
                <div class = "titres">
                    <img class = "logoconnexion" src = "logoconnexion.png">
                    <h2  class = "texteaccueil" style ="text-align : center">Récupération de vos identifiants</h2>
                </div>

                <div class = "recuperation">
                    <div class = "blocId">
                        <center>
                            <form action = "recuperation.php" method="post">
                            <h6>Email :</h6>
                            <!--Il faudra mettre du phppppppp-->
                                <label for = "email" ></label><input type="text" name="MailClient" id="MailClient" /><br />
                            <!--Il faudra mettre du phppppppp-->
                            <p>
                                <input type="submit" value="Récupération" name="Recuperation">
                            </p>
                        </form>
                        </center>
                    </div>
            </div>
        </div>
    </body>
