<?php
session_start();
include '../include/db_connect.php';
mysqli_select_db($connect,'spiderlink');
$user=$_SESSION['username'];
$LINK=$_GET['link'];//$_COOKIE['LinkPlay'];

$SQL="SELECT * FROM db_notelink WHERE AUTHOR='$user' AND LINK='$LINK'";

   if($result = mysqli_query($connect, $SQL)){
       if(mysqli_num_rows($result) > 0){


           while($row = mysqli_fetch_array($result)){
              echo "<div class='item-listNote'>
                      <h6>".$row['NOTE']."</h6>

                    </div>";
           }

           mysqli_free_result($result);
       } else{
           echo "<h3 style='margin:10px'>No records matching your query were found.</h3>";
       }
 }else{
     echo "ERROR: Could not able to execute $SQL. " . mysqli_error($connect);
 }

?>
