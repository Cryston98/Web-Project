<?php
session_start();
include '../include/db_connect.php';

$idUpdate=$_POST['IdLinkToUncomplete'];
$redirect=$_POST['LocationPath1'];
$redirect=$redirect."&?res=";

$user=$_SESSION['username'];

mysqli_select_db($connect,'spiderlink');

$SQL="UPDATE db_tab_link SET FINISH='0' WHERE ID = $idUpdate AND USER='".$user."'";
$result=mysqli_query($connect,$SQL);
if ($result) {
  header('Location:'.$redirect.'succes');
}else{
  $filename = fopen("../bin/logError.ini","a");
  fwrite($filename, 'Eroare Unconfirm Link:'.mysqli_error($connect));
  fclose($filename);
  header('Location:'.$redirect.'error');
}
?>
