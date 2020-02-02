<?php

  session_start();


require("../class/FormClass.php");
require("../class/Mail.php");
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Inscription</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type='text/javascript' src='js/main.js'></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/inscription.css">
    </head>

<?php

if (!empty($_POST)){
  require('../database.php');
  require("../PHPMailer/PHPMailerAutoload.php");
  $check = $bdd->prepare("SELECT * FROM user WHERE Email = ?");
  $check->execute([htmlentities($_POST['Email'])]);
  if($check->fetch()){
    ?>
      <div class="alert alert-danger">
        Cette adresse email est déjà utilisée
      </div>
    <?php
  } else {

    function str_random($length){
      	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
      	return substr(str_shuffle(str_repeat($alphabet, $length)), 0 , $length);
  	}

      $token = str_random(60);

      $req = $bdd->prepare('INSERT INTO user (Email, Mdp, confirmation_token) VALUES(?, ?, ?)');

       $password = password_hash(htmlentities($_POST['Mdp']), PASSWORD_BCRYPT);

       $req->execute(array(htmlentities($_POST['Email']), $password, $token));

       $user_id = $bdd->lastInsertId();

       $mail = new Mail();
       $mail->send_email($token, htmlentities($_POST['Email']), $user_id);


       ?>

        <div class="alert alert-success">
          Vous avez bien été enregistré
        </div>

       <?php

}

}

?>

<h1 style="text-align:center;">Inscription</h1>

<?php
$form = new Formulaire();
$form->add_email("Email", "Email", true);
$form->add_password("Mot de passe", "Mdp", true);
$form->add_submit("Inscription");

?>
<a href = "connexion.php" class="btn btn-primary" style="margin-top:15vh;margin-left:25vw;width:50vw;">Se connecter</a>

</html>
