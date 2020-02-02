<?php

require("../connexion_verify.php");
require("../class/Zip.php");

 //Zip des photos
 $zip = new Zip();
 $zip->create_zip();


header("Location: pageAdmin.php?end=true");

?>
