=== Plogger Badge Widget ===
Contributors: JoshuaMostafa
Donate link: http://joshua.almirun.com/
Tags: widget, images
Requires at least: 2.3.1
Tested up to: 2.3.1
Stable tag: trunk

A simple widget that displays images from a Plogger feed in the sidebar.

== Description ==

This was based initially on the Flickr Badge Widget, but it is a lot 
more basic, and uses a [Plogger](http://www.plogger.org/) library feed 
for its source.

I wrote it because Flickr started wanting to charge me for hosting photos.
I pay a few bucks a month on web hosting, and didn't see the point in 
also paying Flickr, given that uploading via SCP is no harder than using 
jUploadr or whatever. I installed Plogger, which seems to be a 
decent bare-bones replacement.

However, the one thing I missed about Flickr was the nice Wordpress 
widget that showed my photos in the sidebar of my blog. So, I scratched 
my own itch and wrote this widget. Presto - thumbnail images in the 
sidebar.

You just assign it a Plogger feed URL and it does its thing. (The GPL 
PHP RSS library lastRSS is included - which makes this widget GPL too.)

It is still very basic and needs some developer TLC to give it the 
features that Plogger deserves. Hit me up if you can help - I don't have 
much free time, so improvements will be slow if it's just me on my 
own.

== Installation ==

This is how you install it:

1. Put the whole plogger-badge-widget directory into wp-content/plugins.
2. Make sure the "cache" subdirectory is writable by the webserver user.
3. Go to Options in your Wordpress admin panel and switch on the plugin.
4. Add the widget to your sidebar in Presentation / Widgets.

== Frequently Asked Questions ==

= Why doesn't this plugin have feature X? =

Because I have no time. Please feel free to suggest improvements, but 
if you want it done quickly, send me a patch.

== Screenshots ==

1. The thumbnails in your sidebar.
2. The (very basic) widget options.


