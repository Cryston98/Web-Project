<?php

$path="../store/diary/".$_SESSION['username']."/";

function readFileDiary($path,$name){
  $myfile = fopen($path.$name, "r") or die("Unable to open file!");
  $contentRead="";
  while(!feof($myfile)) {
    $contentRead=$contentRead.fgets($myfile);
  }
  fclose($myfile);
  return $contentRead;
}



if(file_exists($path))
{
  foreach (new DirectoryIterator($path) as $fileInfo){
      if($fileInfo->isDot())
        continue;
        $contentFileParm='"'.readFileDiary($path,$fileInfo->getFilename()).'"';
        echo "<tr>
                <td onclick='showDiaryPage(".$contentFileParm.")'>".$fileInfo->getFilename()."</td>";

        echo   '<td>'.($fileInfo->getSize()).' bytes</td>
                <td>'.date('F d Y H:i:s',filemtime($path.$fileInfo->getFilename())).'</td>
              </tr>';
  }
}else{
   echo 'directory ' . $path . ' doesn\'t exist!';
}

?>
