<?php

class Vote {

  private $_bdd;
  private $_table_name;
  private $_former_vote;

  public function __construct(PDO $bdd, $table_name){
    $this->_bdd = $bdd;
    $this->_table_name = $table_name;
  }


  private function recordExists($ref_id, $ip){
        $req = $this->_bdd->prepare("SELECT * FROM photo  WHERE id = ?");
        $req->execute([$ref_id]);
            if ($req->rowCount() == 0){
              throw new Exception('Impossible de voter pour cet enregistrement qui n\'existe plus');
            }
  }

  private function vote($ref_id, $user_id, $vote){

    $this->recordExists($ref_id, $user_id);
    $query = $this->_bdd->prepare("SELECT id, vote FROM ". $this->_table_name . " WHERE ref_id = ? AND user_id = ?");
    $query->execute([$ref_id, $user_id]);
    $vote_record = $query->fetch();
    if ($vote_record){

      if($vote_record["vote"] == $vote){
        $this->_bdd->query("DELETE FROM photo_vote WHERE id = ".$vote_record['id']);
        return false;
      }
      $this->_former_vote = $vote_record;
      $this->_bdd->prepare("UPDATE photo_vote SET vote = ?, created_at = ? WHERE id = ".$vote_record['id'])
      ->execute([$vote, date('y-m-d- H:i:s')]);

      return true;
    }
    $inser = $this->_bdd->prepare("INSERT INTO photo_vote SET ref_id = ?, user_id=?, created_at = ?, vote = $vote");
    $inser->execute([$ref_id, $user_id, date('y-m-d- H:i:s')]);
    return true;

  }

  public function like($ref_id, $user_id){
      if($this->vote($ref_id, $user_id, 1)){
        $sql_part = "";
        if($this->_former_vote){
          $sql_part = ", dislike_count = dislike_count - 1";
        }
        $this->_bdd->query("UPDATE photo SET like_count = like_count + 1 $sql_part WHERE id = $ref_id");
        return true;
      } else {
        $this->_bdd->query("UPDATE photo SET like_count = like_count - 1 WHERE id = $ref_id");
      }
    return false;
  }

  public function dislike($ref_id, $user_id){
    if($this->vote($ref_id, $user_id, 0)){
      $sql_part = "";
      if($this->_former_vote){
        $sql_part = ", like_count = like_count - 1";
      }
      $this->_bdd->query("UPDATE photo SET dislike_count = dislike_count + 1 $sql_part WHERE id = $ref_id");
      return true;
    } else {
      $this->_bdd->query("UPDATE photo SET dislike_count = dislike_count - 1  WHERE id = $ref_id");
    }
    return false;

  }

}





 ?>
