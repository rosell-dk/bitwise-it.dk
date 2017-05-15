+++
date = "2017-05-09"
title = "Performance"
draft = true
description = ""

[menu.main]
  parent = "Expertice"
  weight = 22
+++
# Performance

No one loves a slow website. Neither do Google (and their ranking algorithm). Luckily there are many low hanging fruits and in many cases performance can be drastically improved with just a couple of hours of effort

Here are some techniques that we use:

- Examine the waterfall chart in order to spot bottlenecks
- Move static ressources such as images, CSS and javascript to CDN (also in Wordpress and Drupal)
- Concatenate CSS and javascript (also in Wordpress and Drupal)
- Order scripts and styles for best performance (also in Wordpress and Drupal)
- Defer javascript that can be deferred
- Use [picoquery](http://picoquery.com) instead of jQuery whenever possible. picoQuery is actually developed by us.
- For smaller websites, migration to a static website generator is a possibility. This website is build with [Hugo](http://gohugo.io).
- Move entire static sites to CDN
- Use SVG's and SVG-tricks for icons
- Use webp images on clients that supports it
- Prefer pure CSS to script when possible. For example, the responsive menu on this site is pure CSS.


<!--
Actually, we have even gone as far as creating a very light implementation of a subset of jQuery. This is especially practical and effective when some script needs to manipulate the document before its rendered.

http://www.askapache.com/htaccess/serving-webp-images-for-png-jpg/
http://www.askapache.com/htaccess/

-->

