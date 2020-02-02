<?php
session_start();

if (isset($_GET['QrCode'])){

  require('../database.php');

  $req = $bdd->prepare('SELECT id FROM qrcodes WHERE qrcode = ?');
  $req->execute(array(htmlspecialchars($_GET['QrCode'])));
  while($data = $req->fetch()){
    $_SESSION['Connected'] = $data['id'];
  }

  header('Location: ../index.php');
}

 ?>
