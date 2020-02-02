
<?php
  session_start();
?>

<p>upload en cours</p>

<?php
if(!empty($_POST) && !empty($_POST['Titre']) && !empty($_POST['Contenu'])  && !empty($_POST['Auteur']) && !empty($_FILES)){
  require("../database.php");

  //Gestion de la photo
  $tailleMax = 10485760;
  if($_FILES['Photo']['size'] <= $tailleMax){

            $extensionUpload = strtolower(substr(strrchr($_FILES['Photo']['name'], '.'), 1));
            $titre = htmlspecialchars($_POST["Titre"]);
            $contenu = htmlspecialchars($_POST["Contenu"]);
            $auteur = htmlspecialchars($_POST["Auteur"]);
           $extensionsValides = array("png", "jpg", "jpeg", "pdf", "gif");
         if(in_array($extensionUpload, $extensionsValides)){

           //Recherche du nombre de photo que l'utilisateur a mis afin de les numéroter
          $req = $bdd->prepare("SELECT Chemin from photo WHERE Email = ? ORDER BY id");
          $req->execute(array(htmlspecialchars($_SESSION['Email'])));

          $chemins = array();
          //Si on a un resultat, on récupère la derniere photo
          $compt = 0;
            while ($data = $req->fetch()){
              $compt++;
              }
              $numero = $compt;

            function compress($source, $destination, $quality) {

            $info = getimagesize($source);

            if ($info['mime'] == 'image/jpeg')
                $image = imagecreatefromjpeg($source);

            elseif ($info['mime'] == 'image/gif')
                $image = imagecreatefromgif($source);

            elseif ($info['mime'] == 'image/png')
                $image = imagecreatefrompng($source);

            imagejpeg($image, $destination, $quality);

            return $destination;
        }

            $req->closeCursor();
            $email = $_SESSION['Email'];
            $email = str_replace('.', '_', $email);
            $chemin = '../img/database/'.$email.$numero.'.'.$extensionUpload;
            $photoname = $email.$numero.'.'.$extensionUpload;


           $resultat = move_uploaded_file($_FILES['Photo']['tmp_name'], $chemin);
           if($resultat){

             $source_img = $chemin;
              $destination_img = $chemin;

              $d = compress($source_img, $destination_img, 50);

             $req = $bdd->prepare('INSERT INTO photo (Email, Titre, Contenu, Auteur, Chemin, Categorie) VALUES (?,?,?,?,?,?)');
             $req->execute(array(htmlspecialchars($_SESSION["Email"]),$titre, $contenu, $auteur, $photoname, htmlspecialchars($_POST["categorie"])));
             ?>
             <!-- Photo bien publiée -->
             <?php

             } else{
               $errors["Photo"] = "erreur durant l'importation de la photo";
             }

           }else{
             $errors["Photo"] = 'Votre photo de profil doit être au format gif, jpg, jpeg ou png';
           }

         }else{
           $errors["Photo"] = 'Votre photo de profil ne dois pas dépasser 10Mo';
         }
       }

?>

<SCRIPT LANGUAGE="JavaScript">
document.location.href="upload.php"
</SCRIPT>
