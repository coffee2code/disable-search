=== Disable Search ===
Contributors: coffee2code
Donate link: http://coffee2code.com/donate
Tags: search, disable, coffee2code
Requires at least: 2.8
Tested up to: 2.9.1
Stable tag: 1.1
Version: 1.1

Disable the search capabilities of WordPress.

== Description ==

Disable the search capabilities of WordPress.

Prevent WordPress from allowing and servicing any search requests for the blog.  Specifically, this plugin:

* Prevents the search form from appearing (if the theme uses the standard `get_search_form()` function to display the search form).
* Disables the search widget.
* With or without the search form, the plugin prevents any direct or manual requests by visitors, via either GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your sites 404.php template, if present.


== Installation ==

1. Unzip `disable-search.zip` inside the `/wp-content/plugins/` directory for your site (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress

== Frequently Asked Questions ==

= Will this disable the search capabilities in the admin section of the blog? =

No.


== Changelog ==

= 1.1 =
* Disable/unregister search widget
* Add PHPDoc documentation
* Minor formatting tweaks
* Note compatibility with WP 2.9+
* Drop compatibility with WP older than 2.8
* Update copyright date
* Update readme.txt (including adding Changelog)

= 1.0 =
* Initial release