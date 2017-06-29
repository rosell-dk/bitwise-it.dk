<?php
//header('Content-type: image/webp');

/*
// Create a blank image and add some text
$im = imagecreatetruecolor(220, 20);
$text_color = imagecolorallocate($im, 233, 214, 291);
imagestring($im, 1, 5, 5,  'WebP with PHP!!' . $_SERVER['QUERY_STRING'], $text_color);

// Save the image
imagewebp($im, 'php.webp');

// Serve the image
echo imagewebp($im);

// Free up memory
imagedestroy($im);
*/

//readfile($_SERVER['QUERY_STRING']);


//echo $_SERVER['QUERY_STRING'];
//$filename = $_SERVER['QUERY_STRING'];
$filename = $_GET['file'];

//if (!in_array('save', $_GET)) {
$ext = array_pop(explode('.', $filename));

switch ($ext) {
  case 'jpg':
  case 'jpeg':
    $image = imagecreatefromjpeg($filename);
    break;
  case 'png':
    $image = imagecreatefrompng($filename);
    break;
}

if (!image) {
  echo 'failed';
  return;
}
header('Content-type: image/webp');

// Save the file, if asked to
if (isset($_GET['save'])) {
  imagewebp($image, $filename . '.webp');
}

// Output the file, always
// (the htaccess makes sure that the file is retrieved directly next time)
echo imagewebp($image);

// Free up memory
imagedestroy($im);
?>
