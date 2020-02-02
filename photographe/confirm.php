<?php
session_start();

require("../class/Mail.php");

$mail = new Mail();


$user_id = $_GET['id'];
$token = $_GET['key'];


if($mail->confirm($user_id, $token)){

  ?>
  <div class="alert alert-success">
      Vous avez bien confirmé votre compte
  </div>
  <?php

} else {

  header("index.php");

}

?>
