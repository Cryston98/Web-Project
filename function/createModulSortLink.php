<?php

session_start();
include '../include/db_connect.php';

if (isset($_POST['submitSort']))
{
  $user=$_SESSION['username'];
  $category=$_POST['idCategoryLink'];
  $nameSort=$_POST['nameSort'];
  $priority=(int)$_POST['priorityCategory'];
  $location=$_POST['locationPageNew'];

  mysqli_select_db($connect,'spiderlink');
  $SQL="INSERT INTO db_tab_sort_link (NUME,USER,CATEGORY,PRIORITY) VALUES ('$nameSort','$user','$category','$priority')";
  $result=mysqli_query($connect,$SQL);
  if ($result) {
    mysqli_close($connect);
    //header('Location:'.$urlPage.'?result%20success');
    header('Location:'.$location.'&?result=success');
  }else {
    $error=mysqli_error($connect);
    //mysqli_close($connect); //if connection is closed then error isn't visit
    $filename = fopen("../bin/logError.txt","a");
    fwrite($filename,'Eroare : '.$error.'\n');
    fclose($filename);
    ECHO $error.'\n'.$result;
    header('Location:'.$location.'&?result='.$error);
  }
}

?>
