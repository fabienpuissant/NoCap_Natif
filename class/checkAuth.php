<?php

class Auth{
  static function isLogged(){
    if(isset($_SESSION['Email'])){
      return true;
    } else {
      return false;
    }
  }
}
 ?>
