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
    	<script type="text/javascript" src = "bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/index.css">
    </head>

    <body class="header-bg">

  <?php

  require("database.php");
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
