<?php



function loadData($compt = ''){
  require("database.php");
  $table_photo = "photo";
  $table_vote = "photo_vote";
  $connected = 0;

  if(!isset($_SESSION['Connected'])){
    ?>
    <div class="alert alert-danger">
      Vous n'êtes pas connecté
    </div>


    <div class="upload-btn-wrapper">
  <button class="btn">Se Connecter</button>
    <input type="file" accept="image/*" capture="camera"/>
</div>


    <?php
    $ip = "";

  } else {
    $ip = $_SESSION["Connected"];
    $connected = 1;
  }


  $find_all_post = $bdd->query("SELECT * FROM photo ORDER BY id DESC LIMIT 10");

  while ($data = $find_all_post->fetch()){
  $post = new Image($data['id']);

    $vote = false;
    $req = $bdd->prepare('SELECT * FROM '.$table_vote.' WHERE ref_id = ? AND user_id = ?');
    $req->execute([$data['id'], $ip]);
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
        <div class="vote <?= $vote_class ?>"  data-ref_id = <?= $data['id'] ?>  id = <?= $data['id'] ?>>
          <!--
          <div class="vote_bar">
            <div class="vote_progress" data-ref_id = <?= $data['id'] ?> style="width: <?= ($post->_like_count + $post->_dislike_count) == 0 ? 100 : round(100 * ($post->_like_count / ($post->_like_count + $post->_dislike_count))); ?>%">
            </div>
          </div>!-->

          <div class="vote_btns">
            <div class="vote_btn vote_like" data-vote = 'like' data-ref_id = "<?= $data['id'] ?>" data-user_connected="<?= $connected ?>">
                <img src="<?= $photo; ?>" alt="like icon"><span class = "like_count" data-ref_id = <?= $data['id'] ?>><?= $post->_like_count ?></span>
            </div>
  <!--
            <div class="vote_btn vote_dislike" data-vote = 'dislike' data-ref_id = "<?= $data['id'] ?>" data-user_connected="<?= $connected ?>">
              <img src="img/dislike.png" alt="dislike icon"><span class = "dislike_count" data-ref_id = <?= $data['id'] ?>><?= $post->_dislike_count ?></span>
            </div> !-->
          </div>
        </div>
        </div>
      </div>
      <br/>


  <?php
  }
}



 ?>
