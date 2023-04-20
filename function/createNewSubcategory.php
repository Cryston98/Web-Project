<?php
    session_start();

    $ExternPath='../';
    include $ExternPath.'include/db_connect.php';

    $error_image="Selecteaza o imagine !";


      if(isset($_SESSION['username']))
      {
        $user=$_SESSION['username'];
        echo $_SESSION['username']."<br>";

          if(isset($_POST['btnSaveNewSubcategory']))
          {

              echo "buton apasa<br>";
              $titleSubcategory=$_POST['newNameSubcategory'];
              $parentSubcategory=$_POST['parentSubcategory'];

              echo $parentSubcategory;


              $file = $_FILES['PhotoUP'];
          		if(isset($_FILES['PhotoUP']))
          		{
          		 $image_info = getimagesize($_FILES["PhotoUP"]["tmp_name"]);
          		 $image_width = $image_info[0];
          		 $image_height = $image_info[1];
          		}



              		$fileName=$_FILES['PhotoUP']['name'];
              		$fileTmpName=$_FILES['PhotoUP']['tmp_name'];
              		$fileSize=$_FILES['PhotoUP']['size'];
              		$fileError=$_FILES['PhotoUP']['error'];
              		$fileType=$_FILES['PhotoUP']['type'];
              		$fileExt=explode('.',$fileName);
              		$fileActualExt=strtolower(end($fileExt));
              		$allowed = array('jpg','jpeg','png','ico','gif');

      		if(in_array($fileActualExt,$allowed))
          {

      				if($fileSize<1000000) //2000KB
      				{
          					if($image_height==200 && $image_width==400)
          					{
                      /*  $dir='../images/users/'.$user;
                        if (file_exists($dir)) {
                        }else{
                          mkdir("../images/users/", 0700);
                        }
                      */

                					$fileDestination='../images/users/category/'.$user."_".$titleSubcategory.".".$fileActualExt;
                					move_uploaded_file($fileTmpName,$fileDestination);
                					//header("Location: uploadV1.php?UploadSuccess");

                					 $img_link="images/users/".$user;

                                 //Actualizare Photo
                        					if(file_exists ($fileDestination))
                        					{

                                        mysqli_select_db($connect,'spiderlink');
                                        $SQL="INSERT INTO db_tab_subcategory (TITLE,IMAGE,PARENT,USER) VALUES ('$titleSubcategory','$fileDestination','$parentSubcategory','$user')";
                                        $result=mysqli_query($connect,$SQL);
                                        if ($result) {
                                          mysqli_close($connect);
                                          echo "Success";
                                          //header('Location:'.$urlPage.'?result%20success');
                                          //header('Location:../index.php?result%20success');
                                        }else {

                                          $error=mysqli_error($connect);
                                          echo "<br>Eroare: ".$error."<br>";
                                          mysqli_close($connect);
                                        }
                        					}//END UPDATE

          					}else{
          						$error_image="Selecteaza o imagine patratica . Recomandat 200*400 pixeli.";
          				}
      				}else{
      		        $error_image="Your file is too big!";
      		}
  	}else{
      $error_image="You cannot upload files of this type!";
	  }
  }else{
    echo "Nu este apasat butonul de send. ";
  }
}else{
    $error_image="User is not loged!";
}

echo $error_image;

?>
