<?php

require("../connexion_verify.php");
require("../class/Zip.php");
require("../class/Party.php");



$dossier="../img/database";

$ouverture=opendir($dossier);
$fichier=readdir($ouverture);
$fichier=readdir($ouverture);
while ($fichier=readdir($ouverture)) {
unlink("$dossier/$fichier");
}
closedir($ouverture);



$party = new Party($NbQr);
$party->truncate_table('photo');
$party->truncate_table('photo_vote');

header("Location: pageAdmin.php");

?>
