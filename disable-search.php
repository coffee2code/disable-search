<?php
/**
 * @package Disable_Search
 * @author Scott Reilly
 * @version 1.2
 */
/*
Plugin Name: Disable Search
Version: 1.2
Plugin URI: http://coffee2code.com/wp-plugins/disable-search/
Author: Scott Reilly
Author URI: http://coffee2code.com
Description: Disable the search capabilities of WordPress.

Compatible with WordPress 2.8+, 2.9+, 3.0+, 3.1+.

DEVELOPMENT NOTE: Due to the way WordPress hardcodes the search and inclusion
of the searchform.php file in either the active theme or its parent, it is
not possible for a plugin to prevent loading that form if get_search_form() is
used and the template is present in either theme location.  In order to
prevent the form contained in searchform.php from being shown, the template
file searchform.php must be renamed or deleted from both the current theme and
its parent.

See http://core.trac.wordpress.org/ticket/13239 for my patch that would allow
plugins to hook a filter in locate_template() to "hide" an existing template
file form being detected by WordPress (among other things the filter would
allow).

=>> Read the accompanying readme.txt file for instructions and documentation.
=>> Also, visit the plugin's homepage for additional information and updates.
=>> Or visit: http://wordpress.org/extend/plugins/disable-search/

*/

/*
Copyright (c) 2008-2011 by Scott Reilly (aka coffee2code)

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

if ( !class_exists( 'c2c_DisableSearch' ) ) :

class c2c_DisableSearch {

	/**
	 * Hooks actions and filters.
	 */
	public static function init() {
		add_action( 'widgets_init',    array( __CLASS__, 'disable_search_widget' ), 1 );
		if ( !is_admin() )
			add_action( 'parse_query', array( __CLASS__, 'parse_query' ), 5 );
		add_filter( 'get_search_form', array( __CLASS__, 'get_search_form' ), 1 );
	}

	/**
	 * Disables the built-in WP search widget
	 */
	public static function disable_search_widget() {
		unregister_widget( 'WP_Widget_Search' );
	}

	/**
	 * Returns nothing as the search form.
	 *
	 * @param string $form The search form to be displayed
	 * @return string Always returns an empty string.
	 */
	public static function get_search_form( $form ) {
		return '';
	}

	/**
	 * Unsets all search-related variables in WP_Query object and sets the request as a 404 if a search was attempted.
	 *
	 * @param object $obj A WP_Query object
	 * @return null
	 */
	public static function parse_query( $obj ) {
		if ( $obj->is_search ) {
			unset( $_GET['s'] );
			unset( $_POST['s'] );
			unset( $_REQUEST['s'] );
			$obj->set( 's', '' );
			$obj->is_search = false;
			$obj->set_404();
		}
	}
} // end c2c_DisableSearch


c2c_DisableSearch::init();

endif; // end if !class_exists()

?>