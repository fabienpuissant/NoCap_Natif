<?php

 require("../connexion_verify.php");
 require("../class/Formclass.php");
 require('../class/Party.php');
 require('../class/Zip.php');
 require('../class/myPDF.php');
 require('../class/Qr.php');
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>NoCap</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type='text/javascript' src='js/main.js'></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/inscription.css">
    </head>


<h1 style="text-align:center;margin-top:10vh;">Espace Administrateur</h1>

<h2 style="margin-top:10vh;margin-bottom:10vh;margin-left:10vw;">Création d'une soirée</h2>


 <?php


$form = new Formulaire();
$form->add_number("Nombre de Qr Codes à générer", "NbQr", false);
$form->add_submit('Création');

?>
  <a target="_blank"  class="btn btn-primary" style="width:50vw;margin-top:5vh;margin-left:25vw;" href='qrcodes.pdf'>Télécharger les Qr Codes</a>

  <h3 style="margin-top:10vh;margin-bottom:10vh;margin-left:10vw;">Le planning</h3>

<a href="planning.xlsx" class="btn btn-primary" style="margin-left : 25vw; margin-bottom : 10vh; width: 25vw;">Télecharger</a>

<?php
if(!empty($_POST)){
 if(!empty($_POST['NbQr'])){

   $NbQr = htmlentities($_POST['NbQr']);
   $party = new Party(1);
   $party->truncate_table('qrcodes');
   $dossier="png";

   $ouverture=opendir($dossier);
   $fichier=readdir($ouverture);
   $fichier=readdir($ouverture);
   while ($fichier=readdir($ouverture)) {
   unlink("$dossier/$fichier");
   }
   closedir($ouverture);


   //Creation du pdf
     $qr = new Qr($_POST["NbQr"]);
     $qr->generate($_POST['NbQr']);

     $pdf = new myPDF();
     $pdf->AliasNbPages();
     $pdf->AddPage('P', 'A4', 0);
     $pdf->displayQr($_POST["NbQr"], 20, 20);
     $pdf->Output("F", "qrcodes.pdf", true);
   }
}




?>


</html>
