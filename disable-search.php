<?php
/*
Plugin Name: Disable Search
Version: 1.0
Plugin URI: http://coffee2code.com/wp-plugins/disable-search
Author: Scott Reilly
Author URI: http://coffee2code.com
Description: Disable the search capabilities of WordPress.

Prevent WordPress from allowing and servicing any search requests for the blog.  Specifically, this plugin:

* Prevents the search form from appearing (if the theme is using the standard <code>get_search_form()</code>
  function to retrieve and display the search form).
* Prevents the Search widget from displaying the search form.
* With or without the search form, the plugin prevents any direct or manual requests by visitors, via either
  GET or POST requests, from actually returning any search results.
* Submitted attempts at a search will be given a 404 File Not Found response, rendered by your sites 404.php
  template, if present.

Compatible with WordPress 2.6+, 2.7+.

=>> Read the accompanying readme.txt file for more information.  Also, visit the plugin's homepage
=>> for more information and the latest updates

Installation:

1. Download the file http://coffee2code.com/wp-plugins/disable-search.zip and unzip it into your 
/wp-content/plugins/ directory.
2. Activate the plugin through the 'Plugins' admin menu in WordPress
*/

/*
Copyright (c) 2008-2009 by Scott Reilly (aka coffee2code)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation 
files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, 
modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the 
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

if ( !class_exists('DisableSearch') ) :

class DisableSearch {

	function DisableSearch() {
		if ( !is_admin() ) {
			add_action('parse_query', array(&$this, 'parse_query'));
			add_filter('get_search_form', array(&$this, 'get_search_form'));
		}
	}

	function get_search_form($form) {
		return '';
	}

	function parse_query($obj) {
		if ( $obj->is_search ) {
			unset($_GET['s']);
			unset($_POST['s']);
			unset($_REQUEST['s']);
			$obj->set('s', '');
			$obj->is_search = false;
			$obj->set_404();
		}
	}
} // end DisableSearch

endif; // end if !class_exists()

if ( class_exists('DisableSearch') )
	new DisableSearch();

?>