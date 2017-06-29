+++
date = "2017-05-17T09:49:02+02:00"
draft = false
id = "static-website-generators"
title = "Static website generators"

[menu.main]
  parent = "Expertice"
  weight = 22

+++
# Static website generators
In short, the two major benefits for building a website with a static website generator are the great performance and security that comes with static websites. There are other benefits. The most significant drawback is that it requires more technological skill, from the content managers than i.e. Wordpress does.

## Performance benefits
For many, performance is the most attracting feature of static websites. MailChimp for example listed performance as a major reason for going static in their [public announcement](https://blog.mailchimp.com/building-the-new-mailchimp/).

The reason that static websites outperforms dynamic ones is of course that the server does not have to generate content on the fly. But more importantly, static websites can be put on a CDN. CDN's are optimized to deliver static files fast using different techniques, for example replicating the content to multiple servers around the world. Putting files on a CDN is an easy and very affordable way to get good performance.

However, note that while serving static files is much faster than generating them on the fly, good performance is not ensured with static websites. Large chunks of javascript or CSS may cause slow rendering in the browser. The number of external resources must also be kept low to ensure a fast website.

## Security benefits
Security is another major benefit of static websites. Though not completely ensured, much less can go wrong. A weakness on a server capable of executing scripts is much more to be feared than a vulnerability on a server that is not. 

Things that may happen on an Apache server, when there is a vulnerability in the CMS, PHP or Apache itself:
- malicious code is inserted into your pages. This can in worst case mean that people visiting your site get virus on their computer (yes, you can get a computer virus just from visiting a website which exploit unpatched OS vulnerabilities. The recent [WannaCry](https://en.wikipedia.org/wiki/WannaCry_ransomware_attack) attack did just that)
- database is wiped
- your server is exposed to send unsolicited emails
- your server is exposed to engage in DDOS attacks

### Goodbye, CMS vulnerabilities
In dynamic websites using a CMS such as Drupal or Wordpress, security issues are common. The cores have had many fixes and popular plugins as well. Chances are that there are security problems right now not yet found by the developers, but found by hackers. Also, when security problems in Drupal are fixed, they are announced. Updating the CMS immidiately is not possible, which leaves time for hackers to exploit the weakness before you have your site updated.

### Goodbye, vulnerabilities in LAMP-stack
CMS'es generally run on the LAMP-stack (OS:Linux, Server: Apache, Database: MySQL, script language: PHP). Each of these components can have vulnerabilities.

At the point of writing, there has been:
- [1027 vulnerabilities found in Linux, 33 public exploits](http://www.cvedetails.com/product/47/Linux-Linux-Kernel.html?vendor_id=33)
- [777 vulnerabilities found in Apache, 24 public exploits](https://www.cvedetails.com/vendor/45/Apache.html)
- [261 vulnerabilities found in MySQL, 4 public exploits](https://www.cvedetails.com/vendor/185/Mysql.html)
- [560 vulnerabilities found in PHP, 42 public exploits](https://www.cvedetails.com/vendor/74/PHP.html)

Total LAMP-stack vulnerabilities found until now: 2625\
Total LAMP-stack exploits published until now: 103

## Maintenance benefits

### Goodbye, CMS updates & upgrades
Installing a CMS is fast and cheap. Updating it is not. To stay secure, you need to install updates regularily. As upgrades are known to break sites, you should perform a backup before doing the update. This alone is time-consuming. Also, you should know how to restore the backup, or let someone who does know how to do that perform the update. If downtime is an issue, updating should be tried first on a staging server (= more time consumed). And when the update breaks things, you should know who to call (me, for examle!).

Worse yet, major versions of CMS'es *expire*. This means your site has to be *upgraded* every five years or so. If you have a large site, this can be expensive. "But can't we just STAY on the expired version?" - Well, if you DO that, you should of course know that it makes your site vulnerable (no more security updates). But know that there is another issue lurking: 1) PHP versions *also* expire. 2) PHP is not generally backwards compatible, meaning that a PHP update can break your site. For Drupal 6, this is currently a problem. However, there are vendors out there that provides long term support for Drupal 6 (ie. [Tag 1 Quo](https://quo.tag1consulting.com/)). If you are caught up in this mess, you may want to read [this article](https://www.siteground.com/blog/cms-end-of-life/) -- or [contact *us*](/contact) :)



### Goodbye, Server maintenance
Server maintenance is probably no issue if you are hosting your site on a shared host. But in case you need better performance or a setup that cannot be done on a shared host, you need a server, and also you need that server to be maintained. A VPS itself costs around $10 a month. A "Managed VPS" without root access costs around $40 a month. Having a VPS updated and secured by a professional costs around $100 USD a month.

With a static site on a CDN, there are no maintenance on your part. And CDN's are cheap. For websites that does not have huge amount of traffic, you can get "pay as you go" on https://www.cdn77.com, without monthly fees or minimum payments (watch out: many CDN providers sell "pay as you go" products, where it turns out there is a minimum fee). Their price is currently $0.05/GB. A visit to a website is perhaps 100kb of traffic, meaning that if your site has 1.000.000 visits a month, the price will be $5 a month.

## Content management

The content management part of a static website generator varies with the generator in question. Generally though, it is filebased and done locally. However, there are tools available to setup a web based control panel for the generator. [Tools for Hugo](https://gohugo.io/tools/)

A flexible setup allows you both to be able to work on the site offline and online.

Working offline may sound impractical to some. However, once you have your site generator installed, you probably don't want to go back.

Working on this article, using [Hugo](http://gohugo.io), here is what I do:

1) To create the article, I ran the following command:

```
hugo new expertice/static-website-generators.md". This
```
This generated a new file "content/expertice/static-website-generators.md" containing this:

```
+++
date = "2017-05-17T09:49:02+02:00"
draft = true
title = "Static website generators"
+++
```
Below this frontmatter, I can start writing the article. It is written in markdown. If you don't know markdown, its about time! Basically it is an unobstructive syntax for writing rich text. That is, you can make bold text, headlines, links, etc without resorting to cumbersome HTML. HTML is allowed, though, when you need more than basic formatting. Markdown is very widespread. Many discussion forums support it, Wordpress supports it and there are tools for converting markdown to PDF. 

I opened the file in my favourite text editor, which is gedit. Like many text editors, gedit supports markdown -- headlines becomes green, italic text becomes italic, etc. Working on text in markdown format in a markdown-enabled editor is wonderful.

Here comes the best part: previewing. Hugo is not only able to generate static files, but also to work as a server. It is simply started with the following command in the directory of the site

```
hugo server
```
With hugo server running, I can view my site in my web browser at a local adress, `http://localhost`. I browse to `http://localhost:1313/expertice/static-website-generators/` and see my empty document.

Hugo server automatically detects file changes and rebuilds pages in only 1ms per page. Also, Hugo server inserts some clever javascript that detects the change. The effect is this: Whenever I save my document from the text editor, the webpage in the browser gets reloaded and reflects the changes immidiately. Nice!

When I'm satisfied with the article and want to publish it, I run this command:

```
hugo
```
Hugo then generates the website in a subfolder called "public".

I then use ftp to upload it to the CDN and purge the cache in the CDN. These steps can however also be automated.

To work many on the same project, you need a versioning system such as git. Before working, you fetch updates. When finished working, you push your changes back to the repository. Its actually just I few commands you need to learn. Its possible to set up a system so changes in the git repository automatically triggers a hugo build and pushes it to the CDN.

Want to know more about Hugo? - head over to https://gohugo.io.

[Or, lets have a talk! →](/contact)



<!--

Dynamic websites on a LAMP 


Again, compared to dynamic sites, security with static sites is 

It is easy to put a static site on a CDN, and the CDN 


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


