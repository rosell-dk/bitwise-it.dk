+++
date = "2017-05-04T21:04:32+02:00"
draft = false
title = "bitwise is a tiny IT company based in Copenhagen"
+++

<div style="display:inline-block; width:70%; margin:40px 0 50px 15%; font-size:25px; border:1px solid #2f7ea0; background-color:#2f7ea0; color: white; font-family:serif; padding:20px;">bitwise is a tiny IT company based in Copenhagen. We create websites and web applications</div>


# Expertice
<!--
Wordpress, Drupal, Responsive design, Performance, Static site generators, CDN, VPS, SQL, MySQL, mariadb, server maintenance, control panels, AJAX, markdown, HTML, CSS, Javascript, jQuery, PHP, YAML, XML, crossbrowser, JSON, CSS animation, SVG
-->

## Wordpress and Drupal
- Installation
- Creation of templates/themes from either HTML or a graphical layout
- Setting up various plugins needed for the solution
- Custom plugin development
- Migration
- Insight into the inner workings of Wordpress and Drupal

## Custom web applications
- Custom web applications from scratch, ie on a LAMP stack
- To rapidly create an application, we sometimes use [CakePHP](https://cakephp.org/)

## Static websites
Static websites are trending, and for good reasons. Performance is as great as it comes. Security too. There is virtually no maintenance (no CMS updates to install, no CMS migration to next major version, no server updates, no database problems, etc.). Your content becomes more distributable and reusable. And last, not least: Static site generators are maturing and fun to work with.



<!--
- Performance is as great as it comes\
 - The whole site can be put on a CDN
- Security is as great as it comes\
 - No more worrying whether your CMS has security issues not yet discovered (it probably has)
- No maintenance.\
 - No CMS updates
 - No worrying whether the latest CMS update will break the site.
 - No migration task ahead, when the CMS major version is no longer supported, and it only runs on outdated PHP versions, which have security problems 
 - No server updates
 - No database problems
- It frees your content. By choosing a static site generator which generates the site from markdown files, you can easily:
 - Manage content. For example its easy to send the content files to translation
 - Migrate content to another static site generator that supports markdown files (many do)
 - Use the content for other purposes. For example generate PDFs
- Static site generators are maturing.
 - They are feature-rich
 - They are fast
 - They have many templates
 - They are backed by large communities
 - Its a pleasure to work with

-->
<!--
your content can easily be moved around and used for other purposes -- most static site generators are capable of generating a website from markdown files, which makes it relatively easy to migrate content between site generators. Markdown files can also be used to generate PDF's and Latex documents
If you for example use markdown files for your content
If for example you choose a static site generator which generates sites from markdown files, 
Text files in a filesystem are more easier to move around than content in a database
Static is trending. And for good reasons. First of all, performance is great -- the whole site can be put on a CDN. Also, security is as great as it comes. No more worrying whether your CMS has security issues not yet discovered (it probably has). Also, no worrying whether the latest CMS update will break the site. And no migration task ahead, when the CMS major version is no longer supported, and it only runs on outdated PHP versions, which have security problems. No server updates. 

#Also, your content can easily be moved around and used for other purposes -- most static site generators are capable of generating a website from markdown files, which makes it relatively easy to migrate content between site generators. Markdown files can also be used to generate PDF's and Latex documents

#And of course, your static website can still be dynamic. Want users to be able to comment your articles? - use Discuss. Want a webform? - use [Formspree]https://formspree.io). Want something custom? We can implement it with javascript which calls another server.

#Some CDN's even provide meassures against DDOS attacks.
#Fast websites which can be put on CDN. Great security. No mingling with CMS updates, webserver updates or database issues. And the static site generators are maturing, making it easy and even fun to build static. And its well suited for both for small websites such as blogs and large feature-rich websites. MailChimp is for example a static website.
-->
## Performance

No one loves a slow website. Neither do Google (and their ranking algorithm). Luckily there are many low hanging fruits and in many cases performance can be drastically improved with just a couple of hours of effort

Here are some techniques that we use:

- Examine the waterfall chart in order to spot bottlenecks
- Move static ressources such as images, CSS and javascript to CDN (also in Wordpress and Drupal)
- Concatenate CSS and javascript (also in Wordpress and Drupal)
- Order scripts and styles for best performance (also in Wordpress and Drupal)
- Defer javascript that can be deferred
- Use [picoquery](http://picoquery.com) instead of jQuery whenever possible. picoQuery is actually developed by us.
- Migration to a static website generator is a possibility. Migration tools are available for many CMS'es and static site generators. Btw: The website you are now visiting is build with a static site generator, namely [Hugo](http://gohugo.io). Its fast, isn't it?
- Move entire static sites to CDN
- Use SVG's and SVG-tricks for icons
- Use webp images on clients that supports it
- Prefer pure CSS to script when possible. For example, the responsive menu on this site is pure CSS.


<!--This is what we do:
## Consulting
Anything involving CSS, Javascript, PHP, Apache configuration, Databases, jQuery

- Anything involving CSS, Javascript, PHP, Apache configuration, Databases, jQuery
-->

