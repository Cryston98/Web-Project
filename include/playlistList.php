<?php
include '../include/db_connect.php';


mysqli_select_db($connect,'spiderlink');
$sql = "SELECT TITLE , IMAGE FROM db_tab_playlist WHERE USER='$user'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['TITLE']."'>".$row['TITLE']."</option>";
        }
    }else {
        echo "<option value='noplaylist'>0 results.Trebuie mai intai sa creezi un playlist.</option>";
    }

//mysqli_close($connect); eroare de inchidere prea repede pe anumite pagini
//treuie lucrat la structura


?>
