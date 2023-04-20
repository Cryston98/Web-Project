<?php

session_start();
include '../include/db_connect.php';

if (isset($_POST['SubmitNewNote']))
{
  $note=$_POST['NewNoteInput'];
  $link=$_POST['LinkPlayerURL'];
  $user=$_SESSION['username'];
  $location=$_POST['LocationCall'];
  echo $location;



  mysqli_select_db($connect,'spiderlink');
  $SQL="INSERT INTO db_notelink (AUTHOR,NOTE,LINK) VALUES ('$user','$note','$link')";
  $result=mysqli_query($connect,$SQL);
  if ($result) {
    mysqli_close($connect);
    //header('Location:'.$urlPage.'?result%20success');
    header('Location:'.$location.'&operation%20addNote+result%20success');
  }else {
    $error=mysqli_error($connect);
    //mysqli_close($connect); //if connection is closed then error isn't visit

    $filename = fopen("../bin/logError.txt","a");
    fwrite($filename,'Eroare : '.$error.'\n');
    fclose($filename);
    ECHO $error.'\n'.$result;
    header('Location:'.$location.'&operation%20addNote+result%20'.$error);
  }

}

?>
