=== Disable Search ===
Contributors: coffee2code
Donate link: http://coffee2code.com/donate
Tags: search, disable, coffee2code
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.1.1
Version: 1.1.1

Disable the search capabilities of WordPress.

== Description ==

Disable the search capabilities of WordPress.

Prevent WordPress from allowing and servicing any search requests for the blog.  Specifically, this plugin:

* Prevents the search form from appearing (if the theme uses the standard `get_search_form()` function to display the search form).
* Disables the search widget.
* With or without the search form, the plugin prevents any direct or manual requests by visitors, via either GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your sites 404.php template, if present.

*NOTE:* If your theme (child and/or parent) contains a `searchform.php` template file, you must rename or remove them. Otherwise they will likely be used by the theme to display the search form. The form won't work (thanks to this plugin), but it will still be displayed. WordPress currently does not provide a means for the plugin to circumvent the theme's use of this template file.


== Installation ==

1. Unzip `disable-search.zip` inside the `/wp-content/plugins/` directory for your site (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress
1. If your theme (child and/or parent) contains a searchform.php template, you must rename or remove them, otherwise they will likely be used by the theme to display the search form. The form won't work, but it will still be displayed. WP currently does not allow the plugin to circumvent the theme's use of this file.

== Frequently Asked Questions ==

= Will this disable the search capabilities in the admin section of the blog? =

No.

= Will this prevent Google and other search engines from searching my site? =

No.  This only disables WordPress's capabilities with regards to search.


== Changelog ==

= 1.1.1 =
* Fix disabling of search widget
* Move class instantiation inside of if(!class_exists()) check
* Rename class from 'DisableSearch' to 'c2c_DisableSearch'
* Store object instance in global variable 'c2c_disable_search' for possible external manipulation
* Note compatibility with WP 3.0+
* Minor code reformatting (spacing)
* Remove documentation and instructions from top of plugin file (all of that and more are contained in readme.txt)
* Add Upgrade Notice section to readme.txt

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


== Upgrade Notice ==

= 1.1.1 =
Minor update. Highlights: renamed class and other back-end tweaks; added note about searchform.php; noted compatibility with WP 3.0+.