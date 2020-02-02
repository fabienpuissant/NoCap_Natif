<?php

class Party
{
  private $_name;
  private $_nbQr;


  public function __construct($NbQr){
    $this->_nbQr = $NbQr;
  }

  public function truncate_table($table_name){
    require('../database.php');
    $bdd->query("TRUNCATE TABLE ".$table_name);
  }



}


 ?>
