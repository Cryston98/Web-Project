<?php
$ExternPath="";
$RootPath="index.php";
$PagePath="page/";
$headerURL=$ExternPath.'include/header.php';

include $headerURL;
session_start();


echo '<body>';

if (isset($_SESSION['email'])) {
    $user=$_SESSION['username'];
    include 'include/leftnav.php';
    echo '<div id="container">';
          include 'include/home.php';
          include 'include/footer.php';
    echo '</div>';
}else{
  include 'include/loginForm.php';
}

        echo '</body>';

?>
