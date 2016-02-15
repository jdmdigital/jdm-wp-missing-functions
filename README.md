# JDM Missing WP Functions Plugin

### Handy-Dandy PHP functions that should've been included in WordPress. This plugin fixes that.

WordPress comes with a TON of functions, but it's frustrating when you come across a function need that's not included.

Over time, we've gotten pretty tired of writing and re-writing the same functions for different clients and always wondering why they're not already included in WordPress. So, we created a WordPress plugin (hosted by GitHub) that exposes these handy functions for Theme developers, like us.

## Installation

This plugin is not on the WordPress.org repo.  Here's how to install it and keep it up-to-date.

1.  First, install GitHub Updater. [Here's how](http://labs.jdmdigital.co/plugins/github-updates/). 
2.  Once that's setup, click the "Install Plugin" tab of GitHub Updater and enter this Repo link into the box
3.  Click **Install Plugin** and then click **Back to Plugins**
4.  Click **Activate** under the new plugin

## Usage

After installation, you **won't notice a thing**--hopefully. However, you will now have access to a suite of new functions you can use in your theme to keep things organized, increase performance, and modify layouts, etc.

Check out the Functions Reference below for details about each of the new functions you now have access to.

Got any new ideas? Let us know!

## (New) Functions Reference

**jdm_remove_script_version()** - This function removes all those irritating `?v=1234` from enqued resources. They make browser caching difficult and you just don't need them.

**the_shorter_title()** - When page/post titles get CRAZY long, echo this function in your template to truncate the file length to a set charactor length. Uses WordPress' `get_the_title()` and a little math logic.

**mainsite_url()** - Use this function in your parent/child themes to keep using the root theme file location. That's handy for performance to load `yoursite.com/wp-content/themes/mytheme/js/scripts.js` instead of `subdomain.yoursite.com/wp-content/themes/mytheme/js/scripts.js` when these files are actually identical. Use `get_mainsite_url()` to return rather than echo the result.

**add_image_class()** - This function adds `.img-responsive` to ALL added images. That's ideal if you're using Bootstrap, but you could also just add `.img-responsive{max-width:100%; height:auto;}` to your `style.css` file.

**the_parallax()** - Echos the featured image from a page/post, if there is one. If there isn't, it allows you to set seperate default header images for pages, posts, and category headers.  There's also **the_featured_image** which does pretty much the same thing.

**thisURL()** - Echos the URL of the current page. This function has an option to also return the current query string, if there is one. Handy if another function you're using needs that query string.

**is_child()** - Returns true if the page you are currently on is a child page.  For example, your "About Page" at whatever.com/about/ is NOT considered a child.  It's more of a top-level page. While your team page at whatever.com/about/team/ IS considered a child and this function would return TRUE.

**get_the_content_by_id()** - Returns the filtered content given a specific page or post ID. Handy if you want dynamic content displayed all over the place but edited in only one place.  NOTE: Function does not echo.  It only returns.

**is_post_type($type)** - Pass this function the post type and it returns true or false if that's the kind of type being displayed.

**jdm_responsive_embed()** - Makes auto-embedded videos more responsive. No settings.  It just works best with Bootstrap v4.

* * *

There's a lot more, but that's all the README file time I have right now. ;)
