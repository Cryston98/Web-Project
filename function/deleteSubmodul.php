
<?php
session_start();

include '../include/db_connect.php';

if (isset($_GET['toDelete']))
{
  $category=$_GET['toDelete'];
}else{
    $category="none";
}

echo $category;
if ($category!="none")
{
        $user=$_SESSION['username'];
        mysqli_select_db($connect,'spiderlink');
        mysqli_query($connect,"DELETE FROM db_tab_link WHERE CATEGORY='$category' AND USER='$user'");
        #subcategory sort link
        mysqli_query($connect,"DELETE FROM db_tab_sort_link WHERE CATEGORY='$category' AND USER='$user'");
        mysqli_query($connect,"DELETE FROM db_tab_subcategory WHERE TITLE='$category' AND USER='$user'");
}else{
            $filename = fopen("../bin/logError.txt","a");
            fwrite($filename,'Data'.time(),'Eroare delete module: '.mysqli_error($connect).'\n');
            fclose($filename);
            echo mysqli_error($connect);
}

?>
