<?php

class Image {

  public $_count;
  public $_title;
  public $_content;
  public $_image_path;
  public $_like_count;
  public $_dislike_count;
  public $_date;
  public $_author;
  private $_bdd;
  private $_table;

  public function __construct($count){
    $this->_count = $count;

    $m['01']="Janvier";
    $m['02']="Février";
    $m['03']="Mars";
    $m['04']="Avril";
    $m['05']="Mai";
    $m['06']="Juin";
    $m['07']="Juillet";
    $m['08']="Août";
    $m['09']="Septembre";
    $m['10']="Octobre";
    $m['11']="Novembre";
    $m['12']="Décembre";

    require("database.php");
    $this->_bdd = $bdd;
    $this->_table = " photo ";
    $img_id = $this->_count;
    $query = $this->_bdd->query("SELECT * FROM". $this->_table . "WHERE id = ".$img_id);
    while ($data = $query->fetch()){
      $this->_title = $data["Titre"];
      $this->_author = $data["Auteur"];
      $this->_content = $data["Contenu"];
      $this->_date = date("j", strtotime($data['date']))." ".$m[date('m')]. " ". date("Y", strtotime($data['date']))." à ". date("G:i", strtotime($data['date']));
      $this->_image_path = "img/database/".$data["Chemin"];
      $this->_like_count = $data["like_count"];
      $this->_dislike_count = $data["dislike_count"];

    }
  }


}


 ?>
