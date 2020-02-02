<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Gestion</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    </head>
<?php
require('../class/Qr.php');
require('../class/FormClass.php');
require('../class/myPDF.php');


if (isset($_POST["NombreQr"])){
  $qr = new Qr($_POST["NombreQr"]);
  $qr->generate();
  ob_start();
  $pdf = new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('P', 'A4', 0);
  $pdf->displayQr($_POST["NombreQr"], 20, 20);
  $pdf->Output("I", "Recapitulatf.pdf", true);
  ob_end_flush();
}

$form = new Formulaire;
$form->add_number('Entrer le nombre de QrCode à générer', 'NombreQr');
$form->add_submit('Générer');
?>
