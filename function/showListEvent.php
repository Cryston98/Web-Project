<?php

include '../include/db_connect.php';


mysqli_select_db($connect,'spiderlink');

$SQL="SELECT * FROM db_event_list WHERE USER='$user' AND DATE_E='$dataEvent'";

   if($result = mysqli_query($connect, $SQL)){
       if(mysqli_num_rows($result) > 0){


           while($row = mysqli_fetch_array($result)){
              echo "<div class='item-eventList'>

                         <span><input type='checkbox' name='checkEvent' />".$row['TITLE']."</span>
                             <span id='date_event'>".$row['DATE_E']."</span>

                             <button id='openEvent'><i class='fas fa-door-open inc_bt_play' style='font-size:20px;'></i></button>
                         </a>
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
