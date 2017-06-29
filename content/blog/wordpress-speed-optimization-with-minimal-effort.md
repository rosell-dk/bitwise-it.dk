+++
date = "2017-05-31T09:20:32+02:00"
description = "A case study of a quick standard way to get a Wordpress site faster"
draft = false
title = "Wordpress speed optimization with minimal effort"
toc = false
+++

# Wordpress speed optimization with minimal effort

## A case study of improving speed of a simple Wordpress site</small>

The website http://www.mingo.net wasn't running very quickly. My task was to make it faster with just a few means. 

## Before optimizing
Let's see what we got. Using webpagetest.org, here is a waterfall view of requests made, when visiting the frontpage:

<a href="https://www.webpagetest.org/result/170531_4E_E19/1/details/" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-1-front-waterfall.png"></a>
<small>(click on the image to see the complete report)</small>

Not good. 3.8 seconds to view a page. 

Things to notice:

- Remarkable long time for the server to respond to first request.
- Many CSS files and many JS files

## Page caching and minification of CSS and JS

The long response-time called for page caching. I installed W3TotalCache and activated the page cache. However, as the site has a contact form, I made sure to add an exception not to cache that page.

The number of CSS files and JS files can be decreased with W3TotalCache as well. I choose standard settings and auto, and tested if the site was still working. It was.

Lets see what these few minutes of effort did for the performance:

<a href="https://www.webpagetest.org/result/170531_FA_HND/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-2-front-waterfall.png" ></a>

Much better. From 3.8 seconds to 2.1 seconds total load time, almost 50% reduction. There are fever requests, and the load time for the first request is fairly acceptable now. The load time for the first request is of course of special interest because nothing else is done until this completes.

## CDN

Now most time is spent on loading assets. Especially images takes a lot of time. It is a slow server, so let us move the assets to a CDN instead. For websites with small traffic, CDN hosting it is very cheap *provided you choose a CDN without minimum payments*. It is in fact so cheap that in this case, I don't even bother setting up a separate CDN account for the customer - using mine is easier for both of us.

<!--
Though not neccessary, I set up a CNAME so assets will be available on https://cdn.mingo.net instead of https://d2lhe24liaco7f.cloudfront.net. Its prettier, but it requires a bit more work (setting up a CNAME record and requesting a free custom HTTPS certificate in CloudFront)
Let's check performance with CDN:

<a href="https://www.webpagetest.org/result/170531_RS_WQJ/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-3-front-cdn.png"></a>
-->

Let's check performance with CDN:

<a href="https://www.webpagetest.org/result/170531_RS_WQJ/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-3-front-cdn.png"></a>

That was actually a bit disappointing. Total time is the same. One major caveat is that around 300 ms are spent in resolving DNS and in opening a new HTTP connection (look at third line in the chart, 33be.css). This is the price of having assets on another domain than the HTML. However, the good news is that most browsers caches DNS lookups. On the next visit, the site performs slightly better with CDN than without. On pages with many images, there will be slightly higher benefit.

<!--
https://www.keycdn.com/support/prefetching/#dns-prefetching

On pages with many images, the benefit of using a CDN is real. For this particular site it makes sense to use CDN because there are pages with many images.

It is better now. Though a lot of time is still spent downloading JS and CSS. Unfortunately, there is no quick solution to decrease this further. The selected theme simply uses a lot of javascript (jQuery) and a lot of CSS. -->

## Browser caching

The major issue left is that there is still spent a lot of time downloading JS and CSS. The root of the problem is that the selected theme simply uses a lot of javascript (jQuery) and a lot of CSS - and that it does not defer any of this. This can be dealt with - but not with few means.

What we can do however is to make sure that the JS and CSS is cached on the browser so it will not need to be downloaded on subsequent visits. Browser caching headers can be set in W3TotalCache as well. I set it to maximum for JS and CSS - this is safe because the minification process automatically generates new files when javascript/css is changed. <!-- remember to invalidate files on CDN on this step -->


<!--
The main reason being that the DNS lookup for cdn.mingo.net is very time consuming. How come it takes so much longer than on www? I don't know, but perhaps it is because it is a new DNS record and the record hasn't been cached yet. To test this hypothesis, let's check the DNS lookup time for this website:-->

<!--
## Dissapointing revisit

The day after the above work, I re-ran the performance test and saw this:

<a href="https://www.webpagetest.org/result/170601_WF_GAR/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-5-revisit.png"></a>

The first request now took 665 ms even though we have page caching.
But oh - of course - this must be because I changed a setting (changed CDN), so the cache was invalidated

Subsequent visit


However, testing the site again after a period revealed that the time for the first request was slow again - even with page caching. It 
-->

## Maybe go all static?
Creating static websites with Wordpress has become easy, thanks to Wordpress plugins such as [Cache Enabler](https://wordpress.org/plugins/cache-enabler/), [WP Fastest Cache](https://wordpress.org/plugins/wp-fastest-cache/) or [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/). But we already got everything served statically from the CDN except the first request, which is acceptable fast due to the page cache. So, no, it will not be worthwhile to go all static. Actually, the potential performance benefit can easily be determined: The CDN mirrors every request, not just our assets, so visiting [cdn.mingo.net](https://cdn.mingo.net/) will work.

Running a performance test confirms that the effect would be minimal:

<a href="https://www.webpagetest.org/result/170531_NP_17RG/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-4-front-all-on-cdn.png"></a>

By the way, going static would kill the functionality of the contact form. But that form functionality could be implemented with an external provider, such as [formspree](https://formspree.io/). 


## Wrap up
A performance gain of nearly 50% was quickly achieved just by installing W3TotalCache and configuring page caching and minification of JS and CSS files. Moving assets to a CDN on the other hand takes a bit more time and only had a slight effect. In order to get further improvements, time must be invested in optimizing the theme or finding a leaner theme to replace it.



<!--
In order to improve performance further, 


With a few standard steps its possible to get a decent performance gain. In this case, the site is now about 50% faster.

### What else could have been done?
Page caching got load time of first request down from around 1 second to about 200 ms. 200 ms is much better, but it is not impressive. It must be a very slow server. Moving the site to a faster server would help. It could be done in about an hour.

Alternatively to moving server, we could create a completely static site with a Wordpress plugin such as [Cache Enabler](https://wordpress.org/plugins/cache-enabler/). But that will kill the functionality of the contact form. But that form functionality could be implemented with an external provider, such as [formspree](https://formspree.io/). It would perhaps take a days work to get this done. How much would this benefit performance? This is actually easily determined. As the CDN actually mirrors every request, not just "assets", [cdn.mingo.net](https://cdn.mingo.net/) is actually a static version of the whole site. So lets see:

<a href="https://www.webpagetest.org/result/170531_NP_17RG/1/details/#waterfall_view_step1" target="_blank" class="no-icon"><img src="/images/mingo/webpagetest-4-front-all-on-cdn.png"></a>

Heh - no overall gain. The main reason being that the DNS lookup for cdn.mingo.net is very time consuming. How come it takes so much longer than on www? I don't know, but perhaps it is because it is a new DNS record and the record hasn't been cached yet. To test this hypothesis, let's check the DNS lookup time for this website:

https://stackoverflow.com/questions/36668749/fixing-route-53-cname-alias-slow-reponse-times-with-cloudfront


is that 

How much would it 

The primary performance bottleneck with this site is probably the theme, which uses a lot javascript and a lot of CSS. I could begin optimizing the theme, ie replacing jQuery with [picoQuery](http://picoquery.com) and clean up in unused CSS. Or we could change the theme to a leaner theme. A quick optimization would take about 4 hours. A thourough optimization will take some days of work.

Google PageSpeed tools reports that many images could be optimized. But simply optimizing the jpegs would result in lesser quality. Better would be to use webp-images with fallback to jpeg. At least for the front page. This would require editing the theme.


<!--
about browser caching:
https://varvy.com/pagespeed/cache-control.html
https://www.mnot.net/cache_docs/
-->
<!--
Though it is disappointing that the first request isn't as fast as last test. It must be a very slow server. Moving server is not within this budget. Is there anything else we can do? 

We could create a completely static site with a Wordpress plugin such as [Cache Enabler](https://wordpress.org/plugins/cache-enabler/). But that will kill the functionality of the contact form. But that form functionality could be implemented with an external provider, such as [formspree](https://formspree.io/). But this is beyond budget.
-->





