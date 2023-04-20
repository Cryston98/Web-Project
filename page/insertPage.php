<?php
$ExternPath="../";
$RootPath="../index.php";
$PagePath="";
$urlPage=$_SERVER['REQUEST_URI'];
session_start();
$user=$_SESSION['username'];

include $ExternPath.'include/header.php';

echo '<body>';

      include $ExternPath.'include/leftnav.php';

        echo '<div id="container">';

              include $ExternPath.'include/insertForm.php';


              mysqli_close($connect);


        echo '</div>';

        echo '<div id="PopUpNotification"><h1>Link a fost inserat cu succes!</h1><span id="CloseNotificationPop">X</span></div>';

          include $ExternPath.'include/footer.php';
        echo'</body>';

?>
