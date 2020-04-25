<?php
session_start();
include_once("ClasseConnexion.php");
$maConnexionBD = new Connection(); // nouvelle connection BD
require("../fpdf/fpdf.php"); // Appel de la librairie FPDF


// Création de la classe PDF
class PDF extends FPDF {
  // Header
  function Header() {
    // Logo : 8 >position à gauche du document (en mm), 2 >position en haut du document, 80 >largeur de l'image en mm). La hauteur est calculée automatiquement.
    $this->Image('../images/logosopra.png',2,2,-1000);
    // Saut de ligne 20 mm
    $this->Ln(20);

    // Titre gras (B) police Helbetica de 11
    $this->SetFont('Helvetica','B',20);
    // fond de couleur gris (valeurs en RGB)
    $this->setFillColor(230,230,230);
     // position du coin supérieur gauche par rapport à la marge gauche (mm)
    $this->SetX(70);
    // Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok
    $this->Cell(60,8,'Billet tournoi 2020',0,1,'C',0);
    $this->SetFont('Helvetica','B',18);
    $this->Cell(180,8,'Open Sopra Steria',0,1,'C',0);
    $this->Image('../images/filetdetennis.jpeg',0,150,210);
    $this->Image('../images/balletennis.jpeg',195,2,-500);
    // Saut de ligne 10 mm
    $this->Ln(10);
  }
  // Footer
  function Footer() {
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Helvetica','I',9);
    // Numéro de page, centré (C)
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}


      // On active la classe une fois pour toutes les pages suivantes
    // Format portrait (>P) ou paysage (>L), en mm (ou en points > pts), A4 (ou A5, etc.)
    $pdf = new PDF('P','mm','A4');

    // Nouvelle page A4 (incluant ici logo, titre et pied de page)
    $pdf->AddPage();
    // Polices par défaut : Helvetica taille 9
    $pdf->SetFont('Helvetica','',9);
    // Couleur par défaut : noir
    $pdf->SetTextColor(0);
    // Compteur de pages {nb}
    $pdf->AliasNbPages();

    $pdf->SetFont('Helvetica','B',11);


    // couleur de fond de la cellule : gris clair
    $pdf->setFillColor(100,100,100);
    $pdf->SetFont('Helvetica','B',13);
    $pdf -> Cell(190,6,'INFORMATIONS GENERALES DU CLIENT',0,1,'C',0);
    $pdf->Ln(5);
    // Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise
    $pdf->SetFont('Helvetica','',11);
    $pdf->Cell(75,6,'Mail client: '.$_SESSION['mail'],0,0,'L',0);
    $pdf->Cell(79,6,'Telephone client : ',0,1,'R',0);
    $pdf->Ln(2);
    $pdf->Cell(75,6,'Nom client :',0,0,'L',0);
    $pdf->Cell(75,6,'Prenom client : ',0,1,'R',0);
    $pdf->Ln(2);
    $pdf->Cell(75,6,'Adresse client : ',0,1,'L',0);
    //$pdf->Cell(75,6,strtoupper(utf8_decode($data_voyageur['prenom'].' '.$data_voyageur['nom'])),0,1,'L',1);
    $pdf->Ln(5); // saut de ligne 10mm
    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(190,6,'INFORMATIONS COMMANDE',0,1,'C',0);
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica','',11);
    $pdf->Cell(75,6,'Match : '.$_SESSION['libellematch'],0,0,'L',0);
    $pdf->Cell(75,6,'Date du match :',0,1,'R',0);
    $pdf->Ln(2);
    $pdf->Cell(75,6,'Emplacement : '.$_SESSION['libelleemplacement'],0,0,'L',0);
    $pdf->Cell(81,6,'Creneau du match : ',0,1,'R',0);
    $pdf->Ln(2);
    $pdf->Cell(75,6,'Type de billet : '.$_SESSION['libelletbillet'],0,1,'L',0);
    $pdf-> Ln(10);
    $pdf->SetFont('Helvetica','B',13);
    $pdf->Cell(190,6,'PRIX TOTAL',0,1,'C',0);
    $pdf->SetFont('Helvetica','',12);
    $pdf->Cell(190,6,''.$_SESSION['prixtotal'],0,0,'C',0);









    // affichage à l'écran...
      $pdf->Output('test.pdf','I');

?>
