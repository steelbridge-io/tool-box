<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-03-25
 * Time: 14:45
 */

// Load JS based on template within the page editor.

	function tfs_marketing_image_enqueue() {
        global $typenow;

        if ( isset( $_GET['post'] ) ) {

            $typenow = get_post_meta($_GET['post'], '_wp_page_template', true);
            if ($typenow == 'page-templates/marketing-grid.php') {
                // Registers and enqueues the required javascript for image management within wp dashboard.
                wp_register_script('meta-box-image', get_stylesheet_directory_uri() . '/library/meta-fields/js/cust-meta-image.js', array('jquery'));
                wp_localize_script('meta-box-image', 'meta_image',
                    array(
                        'title' => __('Choose or Upload an Image'),
                        'button' => __('Use this image'),
                    )
                );
                wp_enqueue_script('meta-box-image');
            }
        }
    }
	add_action( 'admin_enqueue_scripts', 'tfs_marketing_image_enqueue' );
