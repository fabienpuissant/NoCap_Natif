<?php

require('../connexion_verify.php');
require('../class/Qr.php');

  $qr = new Qr();

  $qr->generate_inscription();

 ?>
