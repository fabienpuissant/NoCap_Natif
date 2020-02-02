<?php

session_start();

require("database.php");

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  die();
  http_response_code(403);
}

require('class/Vote.php');

if(isset($_SESSION['Connected'])){
  $ip = $_SESSION['Connected'];
  $vote = new Vote($bdd, 'photo_vote');

  if($_POST['vote'] == 1){
    $success = $vote->like($_POST['ref_id'], $_SESSION['Connected']);
  } else {
    $success = $vote->dislike($_POST['ref_id'], $_SESSION['Connected']);
  }

  $req = $bdd->prepare('SELECT like_count, dislike_count FROM photo WHERE id =?');
  $req->execute([$_POST['ref_id']]);
  header('Content-type: application/json');
  $record = $req->fetch(PDO::FETCH_ASSOC);
  $record['success'] = $success;
  die(json_encode($record));

} else {
  ?>
    <script type="text/javascript">
      alert("Veuillez vous connecter");
    </script>
  <?php

}

 ?>
