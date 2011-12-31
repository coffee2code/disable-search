=== Disable Search ===
Contributors: coffee2code
Donate link: http://coffee2code.com/donate
Tags: search, disable, coffee2code
Requires at least: 2.8
Tested up to: 3.3
Stable tag: 1.3
Version: 1.3

Disable the search capabilities of WordPress.


== Description ==

Disable the search capabilities of WordPress.

Prevent WordPress from allowing and servicing any search requests for the blog.  Specifically, this plugin:

* Prevents the search form from appearing (if the theme uses the standard `get_search_form()` function to display the search form).
* Disables the search widget.
** Removes the Search widget from the list of available widgets
** Deactivates any search widgets currently in use in any sidebars (they are hidden, not deleted; they'll still be in the proper locations if this plugin gets deactivated)
* With or without the search form, the plugin prevents any direct or manual requests by visitors, via either GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your sites 404.php template, if present.

*NOTE:* If your theme (child and/or parent) contains a `searchform.php` template file, you must rename or remove them. Otherwise they will likely be used by the theme to display the search form. The form won't work (thanks to this plugin), but it will still be displayed. WordPress currently does not provide a means for the plugin to circumvent the theme's use of this template file.

Until such time as this `searchform.php` override becomes possible, a notice will be shown to admin users on the site's themes and plugins admin pages if the active theme (and/or parent theme) contains a `searchform.php` template. See the FAQ section for how to remove the message if you don't want to remove/rename the template file(s).

Links: [Plugin Homepage](http://coffee2code.com/wp-plugins/disable-search/) | [Plugin Directory Page](http://wordpress.org/extend/plugins/disable-search/) | [Author Homepage](http://coffee2code.com)


== Installation ==

1. Unzip `disable-search.zip` inside the `/wp-content/plugins/` directory for your site (or install via the built-in WordPress plugin installer)
1. Activate the plugin through the 'Plugins' admin menu in WordPress
1. If your theme (child and/or parent) contains a searchform.php template, you must rename or remove them, otherwise they will likely be used by the theme to display the search form. The form won't work, but it will still be displayed. WP currently does not allow the plugin to circumvent the theme's use of this file.


== Frequently Asked Questions ==

= Will this disable the search capabilities in the admin section of the blog? =

No.

= Will this prevent Google and other search engines from searching my site? =

No.  This only disables WordPress's capabilities with regards to search.

= Why do I still see a search form on my site despite having activated this plugin? =

There are two likely reasons:

* Your theme has the markup for the search form hardcoded into the theme's template file. This is generally frowned upon nowadays (the theme should be calling `get_search_form()` to get the search form). There is no way for this plugin to prevent this hardcoded form from being displayed.
* More likely, your theme calls `get_search_form()` and either your currently active theme or its parent theme (if applicable) contains a `searchform.php` template file. Due to the way WordPress is currently coded (still as of WP 3.3), there is no way to prevent WordPress from displaying this file (which contains the markup for the search form). You must rename or remove that template file from both the parent and child themes. Otherwise they will likely be used by the theme to display the search form.

In either case, the form won't work (thanks to this plugin), but it will still be displayed. See http://core.trac.wordpress.org/ticket/13239 for my patch that would allow plugins to hook a filter in locate_template() to "hide" an existing template file from being detected by WordPress (among other things the filter would allow).

= Why do I see the following error notice on my themes and plugins admin pages: "Note: Your present theme (and/or parent theme) contains a searchform.php template file which cannot be overridden by the Disable Search plugin. Presumably the theme uses get_search_form() which will cause the search form to appear."? =

See the second bullet item in the previous FAQ question for an explanation.

= How can I prevent the display of that admin notice (I understand the implications of my theme having a `searchform.php` template and I am unwilling to remove or rename that file)? =

There is a filter that can be hooked to suppress that admin notice. Add to your active theme's functions.php file or in a site-specific plugin:

`add_filter( 'c2c_disable_search_hide_admin_nag', '__return_true' );`


== Changelog ==

= 1.3 =
* Add notice to main themes and plugins admin pages if active theme has searchform.php template
* Note compatibility through WP 3.3+
* Add version() to return plugin version
* Add more documentation and FAQ questions to readme.txt
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

= 1.2.1 =
* Note compatibility through WP 3.2+
* Tiny code formatting change (spacing)
* Fix plugin homepage and author links in description in readme.txt

= 1.2 =
* Switch from object instantiation to direct class function invocation
* Explicitly declare all functions public static
* Add development note
* Add additional FAQ question
* Note compatibility through WP 3.1+
* Update copyright date (2011)

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

= 1.3 =
Minor update: add notice to main themes and plugins admin pages if active theme has searchform.php template; noted compatibility through WP 3.3+.

= 1.2.1 =
Trivial update: noted compatibility through WP 3.2+ and minor documentation tweaks.

= 1.2 =
Trivial update: slight implementation change; noted compatibility through WP 3.1+ and updated copyright date

= 1.1.1 =
Minor update. Highlights: renamed class and other back-end tweaks; added note about searchform.php; noted compatibility with WP 3.0+.