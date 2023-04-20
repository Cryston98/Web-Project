<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

$connect=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}




$email=$_POST['EMAIL'];
$subject=$_POST['SUBJECT'];
$from=$_POST['COME_TO'];



/* PRELUCARE DATE & PREVENTIE XSS , SQL injection,PREVENT MULTI ADD LINK ------------*/
    
	mysqli_select_db($connect,'dbemaillist');
	
	
	 $SQ= "SELECT * FROM db_tab_email WHERE EMAIL = '".$email."'";
	 $rez=mysqli_query($connect,$SQ);

	if(mysqli_num_rows($rez) > 0){
		 header('Location:index.php?addEmil=Email Exist In Database');
	 }else{
			$SQL="INSERT INTO db_tab_email (EMAIL,SUBJECT,COME_TO) VALUES ('$email','$subject','$from')";
			$result=mysqli_query($connect,$SQL);
			
			if ($result)
			{
				mysqli_close($connect);
				header('Location:index.php?addEmil=SUCCESS');
			}else{
				$error=mysqli_error($connect);
				//mysqli_close($connect); //if connection is closed then error isn't visit
				// header('Location:../index.php?result%20error'.$error);
				header('Location:index.php?addEmil=ERROR');
			}
		 
	 }
	 
	
    
   


?>