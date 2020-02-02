<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Résultats</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type='text/javascript' src='js/results.js'></script>
    	<script type="text/javascript" src = "bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/index.css">
            <link rel="stylesheet" href="css/flux.css">
    </head>

    <?php
    $first_field = "Homme";
    $second_field = "Femme";
    $third_field = "Mixte";

    $result_categorie = "Homme";

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

      $result_categorie = $_POST["categorie"];
    }

      ?>
      <form class="" action="" method="post" id = "filter">
        <div class="container">
          <div class = "form-group">
          <?php
          ?>
            <select class="form-control" name="categorie" type = "submit" onchange="submit('filter');" type = "submit">
                <option value="<?= $first_field; ?>"><?= $first_field; ?></option>
                <option value="<?= $second_field; ?>"><?= $second_field; ?></option>
                <option value="<?= $third_field; ?>"><?= $third_field; ?></option>
        </select>
        </div>
      </div>
    </form>
<?php

    require("database.php");
    require("class/Image.php");

    $find_girl = $bdd->prepare("SELECT * FROM photo WHERE Categorie = ? ORDER BY like_count DESC");
    $find_girl->execute(array($result_categorie));
    while($girl_classement = $find_girl->fetch()){
?>
      <div class="container">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= $girl_classement['Titre']; ?></h5>
            <p class="card-text"><?= $girl_classement['Contenu']; ?></p>
            <p class="card-text"><small>Auteur : <?= $girl_classement['Auteur']; ?></small></p>
          </div>
          <img src="<?= "img/database/".$girl_classement['Chemin']; ?>" class="card-img-top photo_actu" alt="image_displayed">
          <div class="vote is_liked" >
            <div class="vote_btns">
              <p class = "card-title" style="margin-top:5vh;margin-bottom:5vh"><strong>Nombre de like : <?= $girl_classement['like_count']; ?></strong></p>
            </div>
          </div>
          </div>
        </div>
        <br/>
<?php

    }


     ?>
