<?php
include('../phpqrcode/qrlib.php');
class Qr {



  public function __construct() {

  }

  public function generate($nb_qr) {

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0 , $length);
    }

    for ($i=0; $i<$nb_qr;$i++){
        $token = str_random(5);
      QRcode::png('http://localhost/NoCap/qrcode/connexion_confirm.php?QrCode='.$token, 'png/test'.$i.'.png');
    }
  }

  public function generate_inscription() {
    QRcode::png('http://localhost/NoCap/photographe/inscription.php', 'Inscription.png');
  }

}


 ?>
