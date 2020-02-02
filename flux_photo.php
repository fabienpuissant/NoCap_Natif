<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Index</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    	<script type='text/javascript' src='js/main.js'></script>
      <script type="text/javascript" src="js/data.js"></script>
      <script type="text/javascript" src="js/results.js"></script>
    	<script type="text/javascript" src = "bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/flux.css">
    </head>

    <body class="header-bg">

  <?php

  require("database.php");
  require("class/FormClass.php");
  $table_photo = "photo";
  $table_vote = "photo_vote";
  $connected = 0;
  $ip = "";

  if(!isset($_SESSION['Connected'])){
    $connected = 0;
    $ip = "";
  } else {
    $ip = $_SESSION["Connected"];
    $connected = 1;
  }
  $first_field = "Homme";
  $second_field = "Femme";
  $third_field = "Mixte";

if($connected){
  if(!empty($_POST["categorie"])){
    $_SESSION['categorie'] = htmlspecialchars($_POST["categorie"]);
    if($_SESSION["categorie"] == "Homme"){
        $first_field = "Homme";
        $second_field = "Femme";
        $third_field = "Mixte";
    } else if ($_SESSION["categorie"] == "Femme"){
      $first_field = "Femme";
      $second_field = "Homme";
      $third_field = "Mixte";
    } else {
      $first_field = "Mixte";
      $second_field = "Homme";
      $third_field = "Femme";
    }
  }
  ?>
    <div class="container">
      <form class="" action="" method="post" id = "filter">
      <div class = "form-group">
      <?php
      ?>
        <select class="form-control" name="categorie" type = "submit" onchange="submit('filter');" >
            <option value="<?= $first_field; ?>"><?= $first_field; ?></option>
            <option value="<?= $second_field; ?>"><?= $second_field; ?></option>
            <option value="<?= $third_field; ?>"><?= $third_field; ?></option>
    </select>
    </div>
</form>
</div>
<?php
} else {
  ?>
    <div class="alert alert-danger">
      Vous n'êtes pas connecté
    </div>
    <div class="upload-btn-wrapper">
<button class="btn">Se Connecter</button>
<input type="file" accept="image/*" capture="camera"/>
</div>

  <?php
}
?>


<input type="hidden" name="" value="<?=  $ip; ?>" id = "ip_content">
<input type="hidden" name="" value="<?=  $connected; ?>" id = "connected_content">

  <div class="container" id = "conteneur_photo">

  </div>

<?php


require('footer.php');
?>
  </body>
  </html>
