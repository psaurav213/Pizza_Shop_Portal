<?php
$data=array(11,22,11,22,11,22); //fill this array with your data
$total=array_sum($data);
for($i=0;$i<count($data);$i++)
{
$arc[$i]=$data[$i]*360/$total;	
}
 
$image = imagecreatetruecolor(505,500) or die("Image can't be created");

$style=IMG_ARC_PIE;
// allocate some colors
$white    = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);
$gray     = imagecolorallocate($image, 0xC0, 0xC0, 0xC0);
$darkgray = imagecolorallocate($image, 0x90, 0x90, 0x90);
$navy     = imagecolorallocate($image, 0x00, 0x00, 0x80);
$darknavy = imagecolorallocate($image, 0x00, 0x00, 0x50);
$red      = imagecolorallocate($image, 0xFF, 0x00, 0x00);
$darkred  = imagecolorallocate($image, 0x90, 0x00, 0x00);
$yellow      = imagecolorallocate($image, 255, 255, 0);
$darkyellow  = imagecolorallocate($image, 0x90, 0x00, 0x00);
$orange      = imagecolorallocate($image, 255, 111, 0);
$darkorange  = imagecolorallocate($image, 0x90, 0x00, 0x00);
$green     = imagecolorallocate($image, 35, 175, 0);
$darkgreen  = imagecolorallocate($image, 0x90, 0x00, 0x00);
$colors=array($red,$gray,$navy,$yellow,$orange,$green);
$darkcolors=array($darkred,$darkgray,$darknavy,$darkyellow,$darkorange,$darkgreen);
$start=0;
// make the 3D effect
for ($i = 60; $i > 50; $i--)
{
	for($j=0;$j<count($data);$j++)
	{   
	imagefilledarc($image, 250, $i*5, 500, 250, $start, $start+$arc[$j],$darkcolors[$j], $style);
    $start=$start+$arc[$j];
	}
}
for($j=0;$j<count($data);$j++)
	{ 
imagefilledarc($image, 250, 250, 500, 250, $start, $start+$arc[$j], $colors[$j], $style);
$start=$start+$arc[$j];
	}
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
