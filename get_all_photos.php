<?php
session_start();

require('database.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  die();
  http_response_code(403);
}

//Stocke tous les noms des photos dans un tableau
$all_photos = [];

$find_all_post = $bdd->prepare("SELECT * FROM photo WHERE Categorie = ? ORDER BY id");
$find_all_post->execute(array($_SESSION['categorie']));
  while ($data = $find_all_post->fetch()){
    $all_photos[] = $data['id'];
  }

    die(json_encode($all_photos));

 ?>
