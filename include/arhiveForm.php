<?php

$user="Cryston";
$directory = "../images/resources/arhive/".$user."/";
$filecount = 0;

$files = glob($directory . "*");
if ($files){
$filecount = count($files);
}

$files1 =array_slice(scandir($directory), 2);
echo '<div id="wrap-back-newPlaylist">';
        for($i = 0; $i < sizeof($files1);$i++)
        {
         echo '
              <span>
                <img class="selectBackground" id="bgnp'.($i+1).'" onclick="sendToCreate(\''.$directory.$files1[$i].'\','.($i+1).'); validateForm()" src="'.$directory.$files1[$i].'"/>
                <img class="ok_icon" id="ok_ic'.($i+1).'" src="'.$ExternPath.'images/icon/ok.png"/>
              </span>';
        }
echo "</div>";




?>
