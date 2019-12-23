<?php
session_start(); 

$width=50;
$height=30;
// generate 5 digit random number
$rand = rand(10000, 99999);

// create the hash for the random number and put it in the session
$_SESSION['e_sri_image_random_value'] = sha1($rand);

//create the image
$image = imagecreate($width, $height);

// use white as the background image
$bgColor = imagecolorallocate ($image, 255, 255, 255); 

$font_size = $height * 0.75;


// the text color is black
$textColor = imagecolorallocate ($image, 0, 0, 0); 

$noise_color = imagecolorallocate($image, 100, 120, 180);
      /* generate random dots in background */
      for( $i=0; $i<($width*$height)/3; $i++ ) {
         imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
      }
      /* generate random lines in background */
      for( $i=0; $i<($width*$height)/150; $i++ ) {
         imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
      }

	/*$x = ($width - $textbox[4])/2;
      $y = ($height - $textbox[5])/2;
      imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
*/

// write the random number
imagestring ($image,$font_size, 5, 8, $rand, $textColor); 


// send several headers to make sure the image is not cached 
// taken directly from the PHP Manual

// Date in the past 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

// always modified 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 

// HTTP/1.1 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 

// HTTP/1.0 
header("Pragma: no-cache"); 

// send the content type header so the image is displayed properly
header('Content-type: image/jpeg');

// send the image to the browser
imagejpeg($image);

// destroy the image to free up the memory
imagedestroy($image);
?>

<html>
<body>

</body>
</html> 