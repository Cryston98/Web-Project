
<?php
session_start();

include '../include/db_connect.php';

if (isset($_GET['note']))
{
  $note=$_GET['note'];
}else{
    $note="default";
}


if (isset($_POST['submitPopUpNewLink']))
{
  $title=$_POST['titleNewLesson'];
  $type=$_POST['typeURLNewLesson'];
  $url=$_POST['urlNewLesson'];
  $category=$_POST['subjectNewLesson'];
  $playlist=$_POST['playlist'];
  $locationRedirect=$_POST['locationPageNew'];
  $user=$_SESSION['username'];

  $ok_to_insertion=false;


/*   ATENTIE TREBUIE SA TESTAM SA NU INTRODUCA GHILIMELE */


  if ($playlist=="noplaylist")
  {
    $filename = fopen("../bin/logError.ini","a");
    fwrite($filename, 'Eroare : Nu exita playlist\nURL: '.$url);
    fclose($filename);
    header('Location:../index.php?result%20error=InvaliPlaylist');
    exit();
    }

  if(strcmp($type, 'youtube') == 0){
      $str=explode('watch?v=', $url, 2);
      if ($str[0]=="https://www.youtube.com/"){
        $url=$str[0].'embed/'.$str[1];
        $ok_to_insertion=true;
      }else{
        $filename = fopen("../bin/logError.ini","a");
        fwrite($filename, 'Eroare : Link Youtube Invalid\nURL: '.$url);
        fclose($filename);
        header('Location:../index.php?result%20error=LinkYoutubeInvalid');
        exit();
      }
  }else if(strcmp($type, 'pdf') == 0){
    $str=substr($url, -4);
    if ($str!=".pdf"){
      $filename = fopen("../bin/logError.ini","a");
      fwrite($filename, 'Eroare : PDF Link Invalid\nURL: '.$url);
      fclose($filename);
      header('Location:../index.php?result%20error=LinkPDF-Invalid');
      exit();
    }else{
      $ok_to_insertion=true;
    }

  }else if(strcmp($type, 'images') == 0){
        $image_file = array(".jpg",".png",".JPG",".PNG");
        $str=substr($url, -4);

//test separat pentru .jpeg

        $i=0;
        $N=count($image_file);
        array_push($image_file,$str);

        while (($i<$N-1) && ($image_file[$i]!=$str))
                $i++;

                if ($image_file[$i]!=$str ){
                    /*în tablou nu există elementul căutat*/
                    $filename = fopen("../bin/logError.ini","a");
                    fwrite($filename, 'Eroare Image Link: Invalid\nURL:'.$url);
                    fclose($filename);
                    header('Location:../index.php?result%20error=ImageLinkInvalid');
                    exit();
               }else{
                    /*avem o coincidenţă la indicele i*/
                    $ok_to_insertion=true;
                  }


  }else if(strcmp($type, 'video') == 0){
    $ok_to_insertion=false;

  }else if(strcmp($type, 'article') == 0){
    $ok_to_insertion=true;

  }

#PRELUCARE DATE & PREVENTIE XSS , SQL injection,PREVENT MULTI ADD LINK;
/*
----
----
---
*/
        if($ok_to_insertion){
              mysqli_select_db($connect,'spiderlink');
              $SQL="INSERT INTO db_tab_link (TITLE,URL,TYPE,SUBJECT,USER,CATEGORY,NOTE,FINISH) VALUES ('$title','$url','$type','$category','$user','$playlist','$note','0')";
              $result=mysqli_query($connect,$SQL);
              if ($result) {
                mysqli_close($connect);
                header('Location:'.$locationRedirect.'&?result%20success');
              //  header('Location:../index.php?result%20success');
              }else {
                $error=mysqli_error($connect);
                //mysqli_close($connect); //if connection is closed then error isn't visit
				echo $error;
                $filename = fopen("../bin/logError.txt","a");
                fwrite($filename,'Data'.time(),'Eroare : '.$error.'\n');
                fclose($filename);
                ECHO $error.'\n'.$result;
              // header('Location:../index.php?result%20error'.$error);
              }
        }

}


 ?>
