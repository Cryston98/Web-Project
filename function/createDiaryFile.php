<?php
session_start();

$contentFile=$_POST['contentDiaryPage'];
$titleFile=$_POST['titleDiaryPage'];
echo $contentFile;
$myfile = fopen("../store/diary/".$_SESSION['username']."/$titleFile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $contentFile);
fclose($myfile);

header('Location:../page/diary.php');

?>
