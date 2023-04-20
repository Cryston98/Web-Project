<?php
$ExternPath="../";
$RootPath="../index.php";
$PagePath="";
session_start();

include $ExternPath.'include/header.php';

echo '<body>';

      include $ExternPath.'include/leftnav.php';

        echo '<div id="container">';

        echo '<div id="TitleCategoryCMS1"><i class="far fa-folder-open"></i><h2>Arhive:</h2><span>&nbsp;../'.$_SESSION['username'].'/</span></div>';
              include $ExternPath.'include/diaryPage.php';

              include $ExternPath.'include/footer.php';
        echo '</div>';
        echo'</body>';

?>
