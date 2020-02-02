<?php

  session_start();

  require("class/checkAuth.php");

  if(Auth::isLogged()){



  } else {

    ?>
    <script type="text/javascript">
      window.location.replace('http://localhost/NoCap/index.php');
    </script>
    <?php

  }

?>
