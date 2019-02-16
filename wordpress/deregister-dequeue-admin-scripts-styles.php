<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-02-15
 * Time: 20:58
 */


/*
Wordpress function that prevents scripts or styles from loading in dashboard where such scripts can conflict with plugins.
*/
// Deregister scripts on all Admin pages due to conflict with Advanced Custom Fields plugin
function load_custom_wp_admin_script() {

	wp_deregister_script('bootstrap_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', true);
	wp_dequeue_script('bootstrap_jquery');
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );
