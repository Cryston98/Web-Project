
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
        $arraySubmodul=array();
        $user=$_SESSION['username'];
        $resultDelete=array();
        $StatusDelete=array();
        mysqli_select_db($connect,'spiderlink');
        $SQL_STEP1="SELECT * FROM db_tab_subcategory WHERE USER='$user' AND PARENT='$category'";
        $cnt1=0; #count of submoduls
        if($resStep1 = mysqli_query($connect, $SQL_STEP1))
        {
               if(mysqli_num_rows($resStep1) > 0)
               {
                   while($row1 = mysqli_fetch_array($resStep1))
                   {
                      $arrayLinkSubmodul[$cnt1]=$row1['TITLE'];
                      $cnt1++;
                   }
                   mysqli_free_result($resStep1);
               }
         }else{
             echo "ERROR: Could not able to execute $SQL. " . mysqli_error($connect);
         }
         echo "<br>".$cnt1."<br>";
        #submodule was determinat to delete
        for ($i=0; $i<$cnt1 ; $i++)
        {
            $cnt2=0;
            $SQL_STEP2="SELECT * FROM db_tab_link WHERE USER='$user' AND CATEGORY='$arrayLinkSubmodul[$i]'";
            if($resStep2 = mysqli_query($connect, $SQL_STEP2))
            {
                if(mysqli_num_rows($resStep2) > 0)
                {
                    while($row2 = mysqli_fetch_array($resStep2))
                    {
                            #delete for every submodule the links
                       mysqli_query($connect,"DELETE FROM db_tab_link WHERE CATEGORY='$arrayLinkSubmodul[$i]' AND USER='$user'");
                       $cnt2++;
                    }
                    mysqli_free_result($resStep2);
                 }
            }else{
                   echo "ERROR: Could not able to execute $SQL. " . mysqli_error($connect);
            }
         #delete for every submodule the category of sort link
         mysqli_query($connect,"DELETE FROM db_tab_sort_link WHERE CATEGORY='$arrayLinkSubmodul[$i]' AND USER='$user'");
         echo $cnt2;#count links for every submodule
        }
      mysqli_query($connect,"DELETE FROM db_tab_playlist WHERE TITLE='$category' AND USER='$user'");
}else{
            $filename = fopen("../bin/logError.txt","a");
            fwrite($filename,'Data'.time(),'Eroare delete module: '.mysqli_error($connect).'\n');
            fclose($filename);
            echo mysqli_error($connect);
}

?>
