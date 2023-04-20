<?php
include '../include/db_connect.php';
session_start();
$user=$_SESSION['username'];

$title=$_POST['titlePLS'];
$image=$_POST['backgroundImg'];


mysqli_select_db($connect,'spiderlink');

$sql = "SELECT * FROM db_tab_playlist WHERE USER='$user' AND TITLE='$title'";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 0){
    $SQL="INSERT INTO db_tab_playlist (TITLE,IMAGE,USER) VALUES ('$title','$image','$user')";
    $rez=mysqli_query($connect,$SQL);
    if ($rez) {
      mysqli_close($connect);
      header('Location:../index.php?result%20success');
    }else {
      mysqli_close($connect);
      header('Location:../index.php?result%20error'.mysqli_error($connect));
    }
}else{
  header('Location:../index.php?result%20error=thisPlaylistExist'.mysqli_error($connect));
}
mysqli_close($connect);
?>
