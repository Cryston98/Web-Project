<?php
$cookie_name="URLImageModul";
if(!isset($_COOKIE[$cookie_name])){
     #Cookie is not set!
     $image="http/ghidsoft.com/images/defaultURL.png"
} else {
     #Cookie is set!;
     $image=$_COOKIE[$cookie_name]; //get image url
}
$size=getimagesize($image);
if ($size[0]==200 && $size[1]==400) {
  setcookie("validURL","OK", time() + (86400 * 30), "/"); // 86400 = 1 day
}else{
  setcookie("validURL", "NO", time() + (86400 * 30), "/"); // 86400 = 1 day
}
?>
