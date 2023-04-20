<?php
    session_start();
    $ExternPath='../';
    include $ExternPath.'include/db_connect.php';

    $error_image="Selecteaza o imagine !";
    $errorFunctionality="";
	  $FileError = fopen("../bin/logError.ini","a");

    if(!isset($_SESSION['username']))
    {
      header('Location:'.$ExternPath.'index.php?status=YouAreNotConnected');
	  }else{
		    $user=$_SESSION['username'];
        if(!isset($_POST['subitNewModul']))
        {
		      header('Location:'.$ExternPath.'index.php?status=DataDontSend');
		    }else{
            $titleModul=$_POST['titleModul'];
			      $typeModul=$_POST['typeModul'];
			      $imageModul=$_POST['imageModul'];
			      $parentModul=$_POST['parentModul'];


		     //test inputs are valid and redirect in case not




		//-----------------------------------------------------------------GET IMAGE LINK IN FUNCTION TYPEMODE IMAGE
		   if(!isset($_COOKIE['TypeModulImage']) or $_COOKIE['TypeModulImage']=="arhive")
			{
				$imageModul="../".$_POST['imageModul'];
			}else if($_COOKIE['TypeModulImage']=="URL"){
				$imageModul=$_POST['imageModulURL'];
		    }else if($_COOKIE['TypeModulImage']=="upload"){
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
					        //Creat directory for all users
							$dir='../images/resources/'.$typeModul.'/'.$user;
						    if (!file_exists($dir)) {
								mkdir("../images/resources/".$typeModul."/".$user, 0700);
							}

							$fileDestination='../images/resources/'.$typeModul.'/'.$user."/".$titleModul.".".$fileActualExt;
                			move_uploaded_file($fileTmpName,$fileDestination);

                            //Verif if photo was uploaded
                        	if(file_exists ($fileDestination))
                        	{
								$imageModul=$fileDestination;
								//$imageModul=substr($fileDestination,3,strlen($fileDestination)-1);	//without caracteres "../"
							}
          				}else{
							fwrite($FileError, 'Error : Add Image '.$typeModul.' is not 200*400px\n');
							fclose($FileError);
							header('Location:../index.php?status=ImageAreNotSize200*400px');
							exit();
          				}
      				}else{
      		            $error_image="Your file is too big!";
						fwrite($FileError, 'Error : Add Image '.$typeModul.' is too big\n');
						fclose($FileError);
						header('Location:../index.php?status=ImageIsTooBig');
						exit();
      		        }
  	            }else{
                    $error_image="You cannot upload files of this type!";
					fwrite($FileError, 'Error : Add Image '.$typeModul.' is not acceptable file\n');
					fclose($FileError);
					header('Location:../index.php?status=ImageFormatIsNotAllowed');
					exit();
	            }
            }

            if($typeModul=="modul")
			{
				$SQLTest = "SELECT * FROM db_tab_playlist WHERE USER='$user' AND TITLE='$titleModul'";
				$SQLInsert = "INSERT INTO db_tab_playlist (TITLE,IMAGE,USER) VALUES ('$titleModul','$imageModul','$user')";
			}else if($typeModul=="submodul"){
				$SQLTest = "SELECT * FROM db_tab_subcategory WHERE USER='$user' AND TITLE='$titleModul' AND PARENT='$parentModul'";
				$SQLInsert = "INSERT INTO db_tab_subcategory (TITLE,IMAGE,PARENT,USER) VALUES ('$titleModul','$imageModul','$parentModul','$user')";
			}



 //-----------------------------------------------------------------TEST EXIST MODUL SUBMODUL AND INSERT
	       mysqli_select_db($connect,'spiderlink');
		    $result = mysqli_query($connect, $SQLTest);
			if (mysqli_num_rows($result) == 0) //Verif if this modul early exist
			{
				$rez=mysqli_query($connect,$SQLInsert);
				if($rez)
				{
					mysqli_close($connect);
					header('Location:../index.php?status=Succes');
				}else{
					fwrite($FileError, 'Eroare : Add new '.$typeModul.'\nURL: '.$mysqli_error($connect));
					fclose($FileError);
					$errorFunctionality=mysqli_error($connect);
					mysqli_close($connect);
					header('Location:../index.php?status='.$errorFunctionality);
				}
			}else{
				mysqli_close($connect);
				header('Location:../index.php?status=ThisModulEarlyExist');
			}

	//-----------------------------------------------------------------eND TEST EXIST MODUL SUBMODUL AND INSERT

		} //END BUTTON SUBIT CLICK
	} //END USER SESIOS EXIST

?>
