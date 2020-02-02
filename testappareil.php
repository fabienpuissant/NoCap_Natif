<?php
include('phpqrcode/qrlib.php');
class Qr {



  public function __construct() {

  }

  public function generate_inscription() {
    QRcode::png('https://nopcap.000webhostapp.com/photographe/inscription.php', 'Inscription.png');
  }


    public function generate_index() {
      QRcode::png('https://nopcap.000webhostapp.com', 'Index.png');
    }


      public function generate_admin() {
        QRcode::png('https://nopcap.000webhostapp.com/admin/admin.php', 'admin.png');
      }


}

$qr = new Qr();
$qr->generate_inscription();
$qr->generate_index();
$qr->generate_admin();


 ?>
