+++
date = "2017-06-02T13:14:38+02:00"
description = ""
draft = false
title = "webp on demand"
toc = false
prettify = true
[menu.main]
  parent = "Blog"
  weight = 22

+++

# webp on demand

I here present a solution for generating and serving a webp image when a jpeg or png image is requested. When the webserver receives a request for a jpeg image that it hasn't converted yet, it converts the file and stores it as ie "logo.jpg.webp". On next request for the same image, the request is routed directly to the generated image. The location of the generated file is customizable. It can either be in the same folder as the source or in a certain location, ie "webp".

The solution excels in its simplicity and is easy to set up. It was also easy to create and I was surpriced that it seems no-one came up with this before. At least, I couldn't find any such implementation.

<!--
The solution easily integrates within any CMS written in php (such as Wordpress and Drupal). There will for example be no need to hook up a routine to be called when images are uploaded to Wordpress media library and a separate hook for popular galleries. It also works great with sites created by static site generators such as Hugo.
-->

The part of serving a webp image when a jpeg image is requested is a well known and stable technique. It even works with CDN's. For that part of my solution, I took code from [this blog post](https://www.keycdn.com/blog/convert-to-webp-the-successor-of-jpeg/) by keycdn.

The other part of the solution is the generation of the webp image is also easily done. Image manipulation, including webp generation, is build into PHP itself (from PHP 5.5.0 and up). So there is no dependency on any modules, which is great.

The solution consists of code to be put in the .htaccess-file and a php-file.

The following should go into your .htaccess file:

```
<IfModule mod_rewrite.c>
  RewriteEngine On
  RewriteBase /

  # First part is standard routing of jpg, jpeg and png images to webp.
  # If you do not want png images to be converted, simply remove "|png" from the code

  RewriteCond %{HTTP_ACCEPT} image/webp
  RewriteRule ^(.*)\.(jpe?g|png)$ $1.$2.webp [T=image/webp,E=accept:1]

  # The second part is created by me (Bjørn Rosell)
  # It delegates webp files to the PHP script unless there already is a 
  # generated webp file in the file system

  # Use these two lines if you want the generated files to be placed
  # in the same folder as the original image, Ie the webp image corresponding to
  # "/images/logo.jpg" will become "/images/logo.jpg.webp"
  # You can set the quality of the generated webp here (a number between 0-100)
  # RewriteCond %{DOCUMENT_ROOT}/$1.webp !-f
  # RewriteRule ^(.*)\.(webp)$ webp-convert.php?file=$1&quality=80 [L]

  # Use these two lines instead, if you want the generated files to be placed in
  # a separate folder, "/webp/". Ie the webp image corresponding to
  # "/images/logo.jpg" will become "/webp/images/logo.jpg.webp"
  # You can change the name of the folder, but make sure to change it both places
  RewriteCond %{DOCUMENT_ROOT}/webp/$1.webp !-f
  RewriteRule ^(.*)\.(webp)$ webp-convert.php?file=$1&quality=80&destination-folder=webp/ [L]

  # If you do not want webp-convert.php to save the converted files, but simply convert and 
  # serve webp images on the fly, you can add "&no-save".
  # You may for example do that if you have your images mirrored by a CDN.
  # With a CDN it does not matter so much that it takes some extra milliseconds for the origin
  # server to serve the webp image.
  # To do this, use the two lines below:
  # RewriteCond %{DOCUMENT_ROOT}/$1.webp !-f
  # RewriteRule ^(.*)\.(webp)$ webp-convert.php?file=$1&quality=80&no-save [L]
</IfModule>

# Next part is also standard technique. Its there for making CDN caching possible
# The effect is that the CDN will cache both the webp image and the jpeg image
# and return the proper image to the proper clients (for this to work, make sure to
# set up CDN to forward the "Accept" header)
<IfModule mod_headers.c>
    Header append Vary Accept env=REDIRECT_accept
</IfModule>

AddType image/webp .webp
```

As indicated in the comments, it is possible to set up the destination folder to be same as the original or a custom folder. You can also set up the desired quality of the webp in the .htaccess.


The php-file must be called "webp-convert.php" and put in the root. It should contain the following:

```php
<?php

$filename = $_GET['file'];
$quality = intval($_GET['quality']);

function echoTextImage($text) {
  $image = imagecreatetruecolor(320, 20);
  imagestring($image, 1, 5, 5,  $text, imagecolorallocate($image, 233, 214, 291));
  echo imagewebp($image);
  imagedestroy($image);
}

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

header('Content-type: image/webp');

if (!$image) {
  echoTextImage('Failed creating image: ' . $_SERVER['QUERY_STRING']);
  return;
}

// Save the file, unless asked not to
if (!isset($_GET['no-save'])) {
  $dest = $_GET['destination-folder'] . $filename . '.webp';
  if (isset($_GET['destination-folder'])) {
    $folders = explode('/', $dest);
    array_pop($folders);
    $folder = implode($folders, '/');
    if (!file_exists($folder)) {
      mkdir($folder, 0755, TRUE);
    }
  }
  imagewebp($image, $dest, $quality);

  if (!file_exists($dest)) {
    echoTextImage('Failed saving image to path: ' . $dest);
    imagedestroy($image);
    return;
  }

  // Serve the saved file
  readfile($dest);
}
else {
  // Just create image, no saving
  echo imagewebp($image, NULL, $quality);
}

// Free up memory
imagedestroy($image);
?>
```




