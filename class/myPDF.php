<?php
require("../fpdf/fpdf.php");

class myPDF extends FPDF{

  public function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial', '', 8);
  }

  public function displayQr($compt, $long, $hauteur){
    $compteur_ligne = 0;
    $compteur_colonne = 0;
    for ($i = 0; $i<$compt; $i++){
      if ($i%10 == 0){
        $compteur_ligne ++;
        $compteur_colonne = 0;
      }

      if ($compteur_ligne == 14){
        $this->AddPage();
        $compteur_ligne = 0;
        $compteur_colonne = 0;
      }
        $this->Image('http://localhost/NoCap/admin/png/test'.$i.'.png',$long*$compteur_colonne,$hauteur*$compteur_ligne,$long,$hauteur,'PNG');
        $compteur_colonne ++;
      }

    }
  }
