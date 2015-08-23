<?php

class Disable_Search_Test extends WP_UnitTestCase {

	function tearDown() {
		parent::tearDown();
		// Ensure the filter gets removed
		remove_filter( 'get_search_form', array( $this, 'output_search_form' ) );
	}

	/*
	 *
	 * HELPER FUNCTIONS
	 *
	 */
	function output_search_form() {
		return '<form><label for="s"><input type="search" name="s" /></label><input type="submit" name="Submit" /></form>';
	}

	function create_posts() {
		$posts = array();
		$posts[] = $this->factory->post->create( array( 'post_content' => 'the man from gallifrey', 'post_title' => 'gallifrey day' ) );
		$posts[] = $this->factory->post->create( array( 'post_content' => 'does not have the search word', 'post_title' => 'no search word here' ) );
		return $posts;
	}


	/*
	 *
	 * TESTS
	 *
	 */


	function test_class_name() {
		$this->assertTrue( class_exists( 'c2c_DisableSearch' ) );
	}

	function test_version() {
		$this->assertEquals( '1.4.2', c2c_DisableSearch::version() );
	}

	/*
	  This test cannot be implemented at this time (as of WP 3.8) because
	  WordPress does not permit locate_template() to be filtered. And
	  since locate_template() uses the STYLESHEETPATH and TEMPLATEPATH
	  constants instead of get_stylesheet_directory() and
	  get_template_directory(), we can't use switch_theme() to switch
	  to twentyeleven, which is the only packaged theme with
	  searchform.php present.
	*/
	function test_no_search_form_apppears_even_if_searchform_php_exists() {
		/* If locate_template() is changed to not use constants, and while
		   twentyeleven is still packaged, the following code could be used
		   as a test until locate_template() is filterable. */

		/*
		$old_theme = get_stylesheet();
		$theme = wp_get_theme( 'twentyeleven' );
		switch_theme( $theme->get_stylesheet() );
		$this->assertEquals( 'twentyeleven', get_stylesheet() );
		// Verify that the searchform.php file actually exists
		$this->assertEquals( 'x', locate_template( 'searchform.php' ) );
		// Now verify that the plugin prevents it from being used
		$this->assertEmpty( get_search_form( false ) );
		// Ensure we restored the original theme
		switch_theme( $old_theme );
		$this->assertEqual( $old_theme, get_stylesheet() );
		*/
	}

	function test_no_search_form_appears_if_filter_is_used_to_show_one() {
		add_filter( 'get_search_form', array( $this, 'output_search_form' ) );

		$this->assertEmpty( get_search_form( false ) );
	}

	/**
	 * NOTE: Hacky as hell! Delves directly into internal handling of widgets by WP
	 * by accessing an implicitly public class variable. WP could change this at
	 * any release. Better if is_widget_registered() gets created.
	 */
	function test_search_widget_is_no_longer_available() {
		$this->assertNotContains( 'WP_Widget_Search', array_keys( $GLOBALS['wp_widget_factory']->widgets ) );
	}

	function test_search_request_returns_no_results_for_main_query() {
		$this->create_posts();

		$this->go_to( '?s=gallifrey' );

		$this->assertTrue( $GLOBALS['wp_query']->is_main_query() );
		$this->assertEmpty( get_query_var( 's' ) );
		$this->assertQueryTrue( 'is_404' );
	}

	function test_search_request_returns_results_for_main_query_if_plugin_disabled() {
		// Remove query altering hook
		remove_action( 'parse_query', array( 'c2c_DisableSearch', 'parse_query' ), 5 );

		$this->create_posts();

		$this->go_to( '?s=gallifrey' );

		$this->assertTrue( $GLOBALS['wp_query']->is_main_query() );
		$this->assertEquals( get_query_var( 's' ), 'gallifrey' );
		$this->assertQueryTrue( 'is_search' );
		$this->assertEquals( 1, count( $GLOBALS['wp_query']->posts ) );

		// Restore query altering hook
		add_action( 'parse_query', array( 'c2c_DisableSearch', 'parse_query' ), 5 );
	}

	function test_search_on_custom_query_returns_results() {
		list( $post_id1, $post_id2 ) = $this->create_posts();

		$query = new WP_Query;
		$posts = $query->query( 's=gallifrey' );

		$this->assertFalse( $query->is_main_query() );
		$this->assertTrue( $query->is_search );
		$this->assertNotEmpty( $posts );
		$this->assertEquals( 1, count( $posts ) );
		$this->assertEquals( $post_id1, $posts[0]->ID );
	}

	/*
	 * TEST TODO:
	 * - Backend search is not affected
	 */
}
