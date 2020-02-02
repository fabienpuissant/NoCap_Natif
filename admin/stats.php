<?php

require("../database.php");

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>NoCap</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type='text/javascript' src='graph.js'></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="css/inscription.css">
    </head>

<?php


$query = $bdd->query("SELECT * FROM photo_vote");

$nb_vote = 0;
$all_time_stamp = [];

while($data = $query->fetch()){
  $nb_vote ++;
  var_dump($data['created_at']);
  $all_time_stamp[] = strtotime($data['created_at']);
}

$compteurs = [];
$compteur = 0;
$interval = 1800;
$inter_compt = 0;
$X = [];


while(min($all_time_stamp) + $compteur * $interval <= max($all_time_stamp)){
  $inter_compt = 0;
  foreach ($all_time_stamp as $key => $value) {
    if($value <= min($all_time_stamp) + ($compteur * ($interval+1)) && $value >= min($all_time_stamp) + ($compteur * $interval)){
      $inter_compt++;
    }
  }
  $X[] = date('H:m', ($compteur * $interval));
  $compteur++;
  $compteurs[] = $inter_compt;
}

$Y = $compteurs;
$datapoints = [];

for ($i=0;$i<count($X); $i++){
  $datapoints[$X[$i]] = $Y[$i];
}


?>
