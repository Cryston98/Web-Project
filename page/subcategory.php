<?php
$ExternPath="../";
$RootPath="../index.php";
$PagePath="";
$urlPage=$_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['username'])) {
  $user=$_SESSION['username'];
}else {
  $user='undefined';
}

include $ExternPath.'include/header.php';

echo '<body>';
    echo '<div id="shadowPopUp"></div>';

      include $ExternPath.'include/leftnav.php';

        echo '<div id="container">';

              include $ExternPath.'include/subcategoryForm.php';




        echo '</div>';

        echo '<div id="PopUpNotification"><h1>Link a fost inserat cu succes!</h1><span id="CloseNotificationPop">X</span></div>';

          include $ExternPath.'include/footer.php';
        echo'</body>';

?>
