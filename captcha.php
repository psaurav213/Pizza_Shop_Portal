<?php
session_start();
$c=array_merge(range(0,9),range('a','z'),range('A','Z'));

$myStr="";
for($i=0;$i<7;$i++)
  $myStr.=$c[array_rand($c)];

$_SESSION["cap"]=$myStr;

$img_width = 90;
$img_height = 50;
header('Content-type: image/png');
$image = imagecreate($img_width, $img_height) or die("Image can't be created"); 
imagecolorallocate($image,255,165,0);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 50,25,18,$myStr,$text_color);
imagepng($image);
imagedestroy($image);
?>