<?php
session_start();

include '../include/db_connect.php';

if (isset($_POST['submitEvent']))
{
  $title=$_POST['titleEvent'];
  $content=$_POST['contentEvent'];
  $dateD=$_POST['dayEvent'];
  $dateM=$_POST['monthEvent'];
  $dateY=$_POST['yearEvent'];

$dta=$dateY.'-'.$dateM.'-'.$dateD;


  $user=$_SESSION['username'];

  echo $title."\n".$content."\n".$dateD."\n".$dateM."\n".$dateY."\n".$user;

        mysqli_select_db($connect,'spiderlink');
        $SQL="INSERT INTO db_event_list (TITLE,CONTENT,DATE_E,USER) VALUES ('$title','$content','$dta','$user')";
        $result=mysqli_query($connect,$SQL);
        if ($result) {
          mysqli_close($connect);
          header('Location:../index.php?result%20success');
        }else {
          $error=mysqli_error($connect);
          ECHO $error.'\n'.$result;
        // header('Location:../index.php?result%20error'.$error);
        }




}
else{
  header('Location:..index.php');
}

?>
