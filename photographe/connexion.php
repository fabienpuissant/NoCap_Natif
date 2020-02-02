<?php

  session_start();


require("../class/FormClass.php");
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Connexion</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type='text/javascript' src='js/main.js'></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    </head>

<?php
if(!empty($_POST) && !empty($_POST['Email'] && !empty($_POST['Mdp']))){
	$errors = array();
require('../database.php');

$req = $bdd->prepare('SELECT * FROM user WHERE Email = ?');
$req->execute([$_POST['Email']]);
$compt = 0;

while($user = $req->fetch()){
  $compt ++;

  if(password_verify($_POST['Mdp'], $user['Mdp'])){
    if($user['confirmation_token'] != 'confirmed') {
      $errors["auth"] = "Veuillez confirmer votre compte";
    } else {
  	   $_SESSION['Email'] = $_POST['Email'];
     }

      } else {
        if(!isset($errors["auth"])){
  	         $errors['error'] = "Identifiant ou mot de passe incorect";
           }

  }

  }

  if ($compt == 0){
    $errors["compte"] = "Vous n'avez pas de compte";
  }

  if(empty($errors)){
    ?>

      <SCRIPT LANGUAGE="JavaScript">
      document.location.href="upload.php"
      </SCRIPT>

    <?php
  }
}




?>


<?php  if(!empty($errors)): ?>

	<div class = "aler alert-danger">
		<?php foreach ($errors as $error): ?>

			<p class = "alert"><?= $error; ?></p>

		<?php endforeach; ?>
	</div>

<?php endif; ?>

<?php


?>
<h1 style="text-align:center;">Connexion</h1>
<?php
$form = new Formulaire();
$form->add_email("Email", "Email", true);
$form->add_password("Mot de passe", "Mdp", true);
$form->add_submit("Connexion");
