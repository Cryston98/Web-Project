<?php

$ExternPath="../";
$RootPath="../index.php";
$PagePath="";

$urlScrapp=$_POST['urlFull'];

include $ExternPath.'include/header.php';

echo '<div id="FullPlayerFrame"><iframe  src="'.$urlScrapp.'" id="Fullplayer" allow="autoplay; encrypted-media" allowfullscreen ></iframe></div>';

?>
