<?php
session_start();

include '../include/db_connect.php';

$email=$_POST['email-log'];
$pass=$_POST['password-log'];

//to prevent mysql injection
$email=stripcslashes($email);
$pass=stripcslashes($pass);
$email=mysqli_real_escape_string($connect, $email);
$pass=mysqli_real_escape_string($connect, $pass);

mysqli_select_db($connect,'spiderlink');
$SQL="SELECT * FROM db_tab_user_account WHERE EMAIL='$email' AND PASSWORD='$pass'";
$result=mysqli_query($connect,$SQL) or die("Failed to connect db".mysqli_error());

    $row=mysqli_fetch_array($result);
    if ($row['EMAIL']==$email && $row['PASSWORD']==$pass) {
      $_SESSION['username']=$row['USERNAME'];
      $_SESSION['email']=$row['EMAIL'];
      $_SESSION['firstname']=$row['FIRSTNAME'];
      $_SESSION['lastname']=$row['LASTNAME'];
      mysqli_close($connect);
      header('Location:../index.php?login%20success');
    }else{
      mysqli_close($connect);
      header('Location:../index.php?login%20error');
    }
  mysqli_close($connect);


?>
