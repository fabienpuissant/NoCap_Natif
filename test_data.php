
<?php

require("class/Image.php");
require('database.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  die();
  http_response_code(403);
}

  $table_photo = "photo";
  $table_vote = "photo_vote";
  $ip = $_POST['ip'];
  $value = $_POST['id'];
  $connected = $_POST['connected'];

  $post = new Image($value);

    $vote = false;
    $req = $bdd->prepare('SELECT * FROM '.$table_vote.' WHERE ref_id = ? AND user_id = ?');
    $req->execute([$value, $ip]);
    $vote = $req->fetch();

    if ($vote){
      if ($vote['vote'] == 1){
        $vote_class = 'is-liked';
        $photo = "img/coeurliked.png";
      } else {
        $vote_class = 'is-disliked';
        $photo = "img/coeur.png";
      }
    } else {
      $vote_class = '';
      $photo = "img/coeur.png";
    }

  ?>

    <div class="container">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $post->_title ?></h5>
          <p class="card-text"><?= $post->_content ?></p>
          <p class="card-text"><small>Auteur : <?= $post->_author ?></small></p>
          <p class="card-text"><small><?= $post->_date ?></small></p>
        </div>
        <img src="<?= $post->_image_path ?>" class="card-img-top photo_actu" alt="image_displayed">
        <div class="vote <?= $vote_class ?>"  data-ref_id = <?= $value ?>  id = <?= $value ?>>
          <div class="vote_btns">
            <div class="vote_btn vote_like" data-vote = 'like' data-ref_id = "<?= $value ?>" data-user_connected="<?= $connected ?>">
                <img src="<?= $photo; ?>" alt="like icon"><span class = "like_count" data-ref_id = <?= $value ?>><?= $post->_like_count ?></span>
            </div>
          </div>
        </div>
        </div>
      </div>
      <br/>
