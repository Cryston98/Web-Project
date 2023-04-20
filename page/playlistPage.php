<?php
$ExternPath="../";
$RootPath="../index.php";
$PagePath="";
session_start();

if (isset($_SESSION['email'])) {
    $user=$_SESSION['username'];
}else {
  $user="";
}


include $ExternPath.'include/header.php';

echo '<body>
        <div id="shadowPopUp"></div>';

      include $ExternPath.'include/leftnav.php';

        echo '<div id="container">';

              include $ExternPath.'include/playlist.php';


        echo '</div>';
          include $ExternPath.'include/footer.php';
        echo'</body>';

?>
