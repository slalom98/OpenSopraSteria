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
    $this->SetFont('Helvetica','B',11);
    // fond de couleur gris (valeurs en RGB)
    $this->setFillColor(230,230,230);
     // position du coin supérieur gauche par rapport à la marge gauche (mm)
    $this->SetX(70);
    // Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok
    $this->Cell(60,8,'Billet tournoi',0,1,'C',1);
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
    $pdf->setFillColor(230,230,230);
    // Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise
    $pdf->Cell(75,6,' mail client: '.$_SESSION['mail'],0,1,'L',1);
    //$pdf->Cell(75,6,strtoupper(utf8_decode($data_voyageur['prenom'].' '.$data_voyageur['nom'])),0,1,'L',1);
    $pdf->Ln(10); // saut de ligne 10mm



    // affichage à l'écran...
      $pdf->Output('test.pdf','I');

?>
