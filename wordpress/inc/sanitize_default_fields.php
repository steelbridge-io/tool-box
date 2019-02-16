<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-02-15
 * Time: 20:24
 */


function sbm_default_meta_save( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'default_nonce' ] ) && wp_verify_nonce( $_POST[ 'default_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves for CTA content
	if( isset( $_POST[ 'default-cta-content' ] ) ) {
		update_post_meta( $post_id, 'default-cta-content', wp_kses_post( $_POST[ 'default-cta-content' ] ) );
	}
}
add_action( 'save_post', 'sbm_default_meta_save' );
