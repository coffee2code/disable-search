=== Disable Search ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: search, disable, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 4.6
Tested up to: 6.6
Stable tag: 2.1

Disable the built-in front-end search capabilities of WordPress.


== Description ==

This plugin prevents WordPress from allowing and handling any search requests from the front-end of the site. Specifically, this plugin:

* Prevents the search form from appearing if the theme uses the standard `get_search_form()` function to display the search form.
* Prevents the search form from appearing if the theme uses a `searchform.php` template
* Prevents the search item from appearing in the admin tool bar when shown on the front-end.
* Disables the search widget.
  * Removes the Search widget from the list of available widgets
  * Deactivates any search widgets currently in use in any sidebars (they are hidden, not deleted; they'll reappear in their original locations if this plugin gets deactivated)
* Disables the search block.
  * Removes the Search block from the list of available blocks
  * Deactivates any search blocks currently in use, such as in posts or as a widget (they are disabled, not deleted; they'll reappear if this plugin gets deactivated and the associated placeholder block doesn't get deleted)
* With or without a search form, the plugin prevents any direct or manual requests by visitors, via either GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your site's 404.php template, if present.
* Disables output of `SearchAction` in SEO schema by the [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) plugin.

The plugin only affects search on the front-end of the site. It does not disable searching in the admin section of the site.

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/disable-search/) | [Plugin Directory Page](https://wordpress.org/plugins/disable-search/) | [GitHub](https://github.com/coffee2code/disable-search/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or install the plugin code inside the plugins directory for your site (typically `/wp-content/plugins/`).
1. Activate the plugin through the 'Plugins' admin menu in WordPress


== Frequently Asked Questions ==

= Will this disable the search capabilities in the admin section of the blog? =

No.

= Will this prevent Google and other search engines from searching my site? =

No. This only disables WordPress's capabilities with regards to search.

Search engines index your site and search their index of your site. They do not make use of your site's native search capabilities. You can only prevent search engines from searching your site by blocking their web crawlers and purging their cache of your site (which is well beyond the scope of this plugin).

= Why do I still see a search form on my site despite having activated this plugin? =

The most likely cause for this is a theme that has the markup for the search form hardcoded into one or more of the theme's template files (excluding `searchform.php`). This is generally frowned upon nowadays (the theme should be calling `get_search_form()` or using `searchform.php` to get the search form). There is no way for this plugin to prevent this hardcoded form from being displayed.

However, even if this is the case, the form won't work (thanks to this plugin), but it will still be displayed.

= Can the front-end search only be selectively disabled, allowing it to appear and work under certain conditions (such as only for logged-in users, etc)? =

No, not at this time, though it is feature being considered. (In truth, custom coding could certainly be used to achieve this, but that obviously requires coding knowledge.)

= Is this plugin GDPR-compliant? =

Yes. This plugin does not collect, store, or disseminate any information from any users or site visitors.

= Does this plugin include unit tests? =

Yes. The tests are not packaged in the release .zip file or included in plugins.svn.wordpress.org, but can be found in the [plugin's GitHub repository](https://github.com/coffee2code/disable-search/).


== Changelog ==

= 2.1 (2024-08-08) =
* Change: Remove the admin bar search field with a higher priority than what it was changed to in WP 6.6.
* Change: Check if core/search block is registered before attempting to unregister. Props toru.
* Change: Note compatibility through WP 6.6+
* Change: Update copyright date (2024)
* Change: Remove development and testing-related files from release packaging
* Unit tests:
    * Hardening: Prevent direct web access to `bootstrap.php`
    * Fix: Define functions now expected by the bundled theme being used
* New: Add some potential TODO items

= 2.0.1 (2023-09-02) =
* Change: Safeguard JS from throwing error if WP JS isn't loaded (should be rare to never)
* Change: Note compatibility through WP 6.3+
* Change: Update copyright date (2023)
* Change: Tweak code alignment
* New: Add `.gitignore` file
* Unit tests:
    * Fix: Allow tests to run against current versions of WordPress
    * New: Add `composer.json` for PHPUnit Polyfill dependency
    * Change: Prevent PHP warnings due to missing core-related generated files

= 2.0 (2021-09-13) =
Highlights:

* This release finally addresses disabling the search block, notes compatibility through WP 5.8+, and restructures unit test directories.

Details:

* New: Disable the search block
    * New: Add `disable_core_search_block()` to unregister block via PHP
    * New: Add `enqueue_block_editor_assets()` to register JS script to unregister search block via JS
    * New: Add JS script file to unregister search block
    * Change: Update documentation to reflect search block being disabled
* Change: Remove `get_search_form()` and simply use `__return_empty_string()` as callback to `'get_search_form'` filter
* Change: Note compatibility through WP 5.8+
* Change: Tweak installation instruction
* Unit tests:
    * Change: Restructure unit test directories
        * Change: Move `phpunit/` into `tests/`
        * Change: Move `phpunit/bin` into `tests/`
    * Change: Remove 'test-' prefix from unit test file
    * Change: In bootstrap, store path to plugin file constant
    * Change: In bootstrap, add backcompat for PHPUnit pre-v6.0

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/disable-search/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.1 =
Minor update: updated removal of admin bar search field, checked if core/search block is registered before attempting to unregister, noted compatibility through WP 6.6+, removed unit tests from release packaging, and updated copyright date (2024)

= 2.0.1 =
Trivial update: noted compatibility through WP 6.3+, updated unit tests to run against latest WordPress, and updated copyright date (2023)

= 2.0 =
Recommended update: disabled the search block, noted compatibility through WP 5.8+, and restructured unit test directories.

= 1.8.3 =
Bugfix update: prevented PHP warnings when running under PHP 8 and actually prevent object unserialization.

= 1.8.2 =
Trivial update: noted compatibility through WP 5.7+, added some additional unit tests, tweaked readme.txt, and updated copyright date (2021).

= 1.8.1 =
Trivial update: Restructured unit test file structure and noted compatibility through WP 5.5+.

= 1.8 =
Minor update: Disabled output of SearchAction from schema output by the Yoast SEO plugin, added TODO.md file, updated a few URLs to be HTTPS, added more unit tests, and noted compatibility through WP 5.4+

= 1.7.2 =
Trivial update: noted compatibility through WP 5.3+, fixed minor unit test warning, and updated copyright date (2020).

= 1.7.1 =
Trivial update: modernized unit tests and noted compatibility through WP 5.2+

= 1.7 =
Minor update: tweaked plugin initialization, noted compatibility through WP 5.1+, created CHANGELOG.md to store historical changelog outside of readme.txt, and updated copyright date (2019)

= 1.6.1 =
Minor update: fixed unit tests, added README.md, noted GDPR compliance, noted compatibility through WP 4.9+. and updated copyright date (2018)

= 1.6 =
Minor update: disabled search item from front-end admin bar, compatibility is now WP 4.6 through 4.7+, and other minor tweaks

= 1.5.1 =
Bugfix release for bug introduced in v1.5.

= 1.5 =
Minor update: set 404 HTTP status for requests to disabled search requests, verified compatibility through WP 4.4, updated copyright date (2016)

= 1.4.2 =
Trivial update: noted compatibility through WP 4.3+

= 1.4.1 =
Trivial update: noted compatibility through WP 4.1+ and updated copyright date (2015)

= 1.4 =
Recommended update: removed admin nag about presence of searchform.php; only affect main query; added unit tests; noted compatibility through WP 3.8+

= 1.3.1 =
Trivial update: only show admin notice for users with 'edit_themes' capability; noted compatibility through WP 3.5+; explicitly stated license

= 1.3 =
Minor update: add notice to main themes and plugins admin pages if active theme has searchform.php template; noted compatibility through WP 3.3+.

= 1.2.1 =
Trivial update: noted compatibility through WP 3.2+ and minor documentation tweaks.

= 1.2 =
Trivial update: slight implementation change; noted compatibility through WP 3.1+ and updated copyright date

= 1.1.1 =
Minor update. Highlights: renamed class and other back-end tweaks; added note about searchform.php; noted compatibility with WP 3.0+.
