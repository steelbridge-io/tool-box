<?php
/*
    Plugin Name: My Google Analytics Plugin
    Plugin URI: http://steelbridge.io/google-analytics-plugin-for-you
    Description: Adds your Google analytics trascking code to the <head> of your theme.
    Author: Chris Parsons
    Version: 1.0
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

function my_google_analytics() { ?>

	<!-- Add Google Analytics Script Here -->

<?php }
add_action( 'wp_head', 'my_google_analytics', 10 );

