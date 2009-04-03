=== Disable Search ===
Contributors: Scott Reilly
Donate link: http://coffee2code.com
Tags: search, disable
Requires at least: 2.6
Tested up to: 2.7.1
Stable tag: trunk
Version: 1.0

Disable the search capabilities of WordPress.

== Description ==

Disable the search capabilities of WordPress.

Prevent WordPress from allowing and servicing any search requests for the blog.  Specifically, this plugin:

* Prevents the search form from appearing (if the theme is uses the standard `get_search_form()` function to retrieve and display the search form).
* Prevents the Search widget from displaying the search form.
* With or without the search form, the plugin prevents any direct or manual requests by visitors, via either GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your sites 404.php template, if present.


== Installation ==

1. Unzip `disable-search-v1.0.zip` inside the `/wp-content/plugins/` directory for your site
1. Activate the plugin through the 'Plugins' admin menu in WordPress

== Frequently Asked Questions ==

= Will this disable the search capabilities in the admin section of the blog? =

No.


