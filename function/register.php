<?php
session_start();

include '../include/db_connect.php';

$user=$_POST['userName-reg'];
$firstName=$_POST['firstName-reg'];
$lastName=$_POST['lastName-reg'];
$email=$_POST['email=reg'];
$password=$_POST['password-reg'];
$conf_password=$_POST['conf-password-reg'];

//to prevent mysql injection
$user=stripcslashes($user);
$firstName=stripcslashes($firstName);
$lastName=stripcslashes($lastName);
$email=stripcslashes($email);
$password=stripcslashes($password);
$conf_password=stripcslashes($conf_password);

$user=mysqli_real_escape_string($connect, $user);
$firstName=mysqli_real_escape_string($connect, $firstName);
$lastName=mysqli_real_escape_string($connect, $lastName);
$email=mysqli_real_escape_string($connect, $email);
$password=mysqli_real_escape_string($connect, $password);
$conf_password=mysqli_real_escape_string($connect, $conf_password);

if ($password==$conf_password)
{
    mysqli_select_db($connect,'spiderlink');
    $SQL="INSERT INTO db_tab_user_account (USERNAME,FIRSTNAME,LASTNAME,EMAIL,PASSWORD,STATUS) VALUES ('$user','$firstName','$lastName','$email','$password','basic')";
    $result=mysqli_query($connect,$SQL);
    if ($result) {
      $_SESSION['username']=$user;
      $_SESSION['email']=$email;
      $_SESSION['firstname']=$firstName;
      $_SESSION['lastname']=$lastName;
      mysqli_close($connect);
      header('Location:../index.php?register%20success');
    }else {
          $error=mysqli_error($connect);
        //  echo $error;
          mysqli_close($connect);
          header('Location:../index.php?register%20error');
    }
}else{
  header('Location:../index.php?register%20NCP');
}
mysqli_close($connect);

?>
