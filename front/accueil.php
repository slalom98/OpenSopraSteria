<?php session_start(); ?>
<!doctype HMTL>
<html >

<!--?php //Test de session
    if (isset($_SESSION['mail'])){
        echo $_SESSION['mail'];
    }
?-->
    <head>
        <title>OPEN SOPRA STERIA </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/design.css">
    </head>
 <body>

     <div class = "block1"> <!-- page d'accueil du site ! -->
     <h1>OPEN TOURNOI SOPRA STERIA</h1>
         <p> Bienvenue au tournoi de Tennis Sopra Steria 2020 super</p>
     </div>
         <div class = "block2diapo">
             <video controls poster="joueurdetennis1.jpg" width = "400" height = "290" >
             <source src = "filrougediapo.mp4"/>
            <source src = "filrougediapo.webm"/>
            <source src = "filrougediapo.ogv"/>
             </video>
         </div>


         <div class = "block3">
             <nav>
             <ul id = "menu"><!-- menu de navigation du site -->
                <li><img src="../images/logosopra.png" width="70%" height="70%"> </li>
                 <li><a href = "#"> Actualités </a> </li>
                 <li> <a href = "#">  Billeterie </a></li>
                 <li> <a href="#">Planning Match</a></li>
                 <li> <a href="#">Résultats</a></li>

                 <?php

                if(isset($_SESSION['mail'])){
                    //echo '<a href = "moncompte.php"><button class="favorite styled" type="button"> Billeterie </button></a></input>';
                    echo '<form action="" method="post">';
                    echo '<input class="favorite styled" type="submit" name="deco" value="Se deconnecter">';
                    echo '</form>';
                    	if(isset($_POST['deco']))
                    	{

                    		 include_once("ClasseConnexion.php");
                    		 $co = new Connection();
                             $co->disconnect();

                    	}
                }
                else{
                    echo '<a href = "seconnecter.php"><button class="favorite styled" type="button"> Se Connecter </button></a></input>';
                    echo '<a href = "sinscrire.php"><button class="favorite styled" type="button"> S&apos;Inscrire </button></a></input>';
                }
                ?>



                </ul></nav></div>


             <div class = "block4">
                 <h2>Actualité du tournoi en temps réel</h2>

             <h3>Aujourd'hui 10h36 :</h3> Bastien Anginieur a gagné le match de quart de finale. Revivez sa balle de match ! <a href = "https://www.youtube.com/?hl=fr&gl=FR"> liens vers la vidéo </a>
            <br> <br> <h3>Aujourd'hui 9h52 :</h3> Le match Cazely/Busquet commence en folie ! Cazelly qui a déjà gagné 2 matchs, se verra t-il se qualifier pour les quards de final ? <br> <br>
            <h3>Aujourd'hui 8h00 :</h3> La journée s'annonce ensoleillée, le premier match de la journée Quemar/Anginieur commence. <br> <br>
            <h3>Hier 21h10 :</h3> Le dernier match de la journée s'achève. C'est le champion renommé Nadal qui se qualifie directemeent en demi final. Qui sera son prochain adversaire ? <br> <br>



                 </div>

             <div class = "block5">
                 Prochain match dans<br>
                  <iframe src="https://static.rolex.com/clocks/2019/roland_garros_white_fr_HTML_188x65/rolex.html" scrolling="NO" style="width:188px;height:65px;border:0;margin:0;padding:0;overflow:hidden;scroll:none; " data-v-6d73303a="" frameborder="NO"></iframe>
             </div>


             <div class = "block6">
              <h2> Actualité générale du tournoi</h2>
                 <p> <li>Rafael Nadal nouvel entraineur de Martin Quemar. Cet ancien joueur de Tennis a décidé de se réorienter pour devenir le nouvel entraîneur de <a href="#">lire la suite</a></li> <br> <Br>

                <li >La 35e édition de l’Open Super 12 Crédit agricole débute avec un premier temps fort ce week-end : les qualifications internationales. Le tournoi alréen réunit l’élite des jeunes joueurs de la catégorie des 12 ans. Rafael Nadal, Andy Murray, Kim Clijsters… Depuis sa création, il a vu passer de nombreux grands noms du tennis mondial. Les finales auront lieu dimanche 1er mars, sur les courts du Tennis-club d’Auray. </li> <br> <br>
                <li>Pendant neuf jours, 312 matchs sont programmés. Ils se déroulent sur 13 courts couverts. Neuf sont en extérieur. En partenariat avec les tennis-clubs de Erdeven, Baden et Pluneret, chacune de ces communes accueillent, en plus d’Auray, des matchs. En tout, l’an dernier, 400 tubes de balles ont été utilisés.</li> <br> <br>

                <li>1500 : C’est le nombre de spectateurs qui assistent aux finales, le dernier dimanche du tournoi. En plus des finales, tous les matchs qui ont lieu à Auray sont aussi visibles sur Youtube, sur une chaîne dédiée. En 2019, les vidéos ont enregistré 1,4 million de vues, d’une durée moyenne de 5 mn. Soit 120 000 heures de visionnage, l’équivalent d’un Stade de France complet pendant une heure trente.</li> </p>
             </div>

             <div class = "block7">
                 <h2> Nos Partenaires</h2>
                 <!-- insérer des images -->
                 <ul id = "bottom1">
                 <li ><a href = "#"> Contact </a></li> <br>
                 <li > <a href = "#"> Mentions légales</a></li>
                     </ul>
                 <ul id = "bottom2">
                 <li> <a href = "https://www.instagram.com/opensoprasteriadelyon/?hl=fr"> <img id = "logo" src = "instagram.jpeg"> </a></li>
                 <li> <a href = "https://www.facebook.com/opensoprasteria/"> <img id = "logo" src ="logofacebook.png"> </a></li>
                 <li> <a href = "https://twitter.com/opensoprasteria?lang=fr"> <img id = "logo" src = "logotwitter.png"></a></li>
                 </ul>

             </div>
</html>
