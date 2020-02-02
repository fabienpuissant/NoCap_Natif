<?php

  session_start();

  require("../class/checkAuth.php");

  if(Auth::isLogged()){



  } else {

    ?>
    <script type="text/javascript">
      window.location.replace('http://localhost/NoCap/index.php');
    </script>
    <?php

  }

require("../class/FormClass.php");
require("menu.php");

?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
    	<meta name="keywords" content="xhtml, html5, form" />
    	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<title>Index</title>
    		<script src ="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
    	<script type="text/javascript" src = "../bootstrap/js/bootstrap.js"></script>
    	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="upload.css">
    </head>



<h1 style="text-align:center;margin-bottom:10vh;">Importer une photo</h1>
<?php

$form = new Formulaire('upload_file.php');
?>
  <div class="form-group">
    <input type="file" name="Photo" accept="image/*" capture/>
  </div>
<?php

$form->add_text("Titre", "Titre", true);
$form->add_text("Description", "Contenu", true);
$form->add_text("Auteur", "Auteur");
$form->add_list("Catégorie", array("Homme", "Femme", "Mixte"), "categorie");
 ?>
 <input type="submit" name='submit_image' value="Envoyer" onclick='upload_image();'/>
 </form>
</div>
