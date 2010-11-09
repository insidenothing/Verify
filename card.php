<?php
if($_GET[rotate]){
	$degrees = $_GET[rotate];
}else{
	$degrees = 0;
}
// avoid the bug:
if(($degrees%90)==0){$degrees+= 0.001;}
	$iwidth = 800;
	$iheight= 389;
	$src = 'card.png';
      $image=imagecreatetruecolor($iwidth,$iheight);
      imagealphablending($image,false);
      $col=imagecolorallocatealpha($image,255,255,255,127);
      imagefilledrectangle($image,0,0,$iwidth,$iheight,$col);
      imagealphablending($image,true);
	  $srcimage=imagecreatefrompng($src);
	  imagecopyresampled($image,$srcimage,0,0,0,0, $iwidth,$iheight,$iwidth,$iheight);
	  $rotate = imagerotate($image, $degrees, 1, 0) ;
      header("Content-Type: image/png;");
      imagealphablending($rotate,false);
      imagesavealpha($rotate,true);
	  imagepng($rotate);
?> 