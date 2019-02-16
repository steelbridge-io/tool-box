<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-02-15
 * Time: 20:20
 */

include( 'inc/sanitize_default_fields.php' );

function chris_custom_default_meta() {
	global $post;
	//if(!empty($post)){
	$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
	if($pageTemplate == 'page.php' || 'front.php' || 'kitchen-sink.php' ) {
		$types = array( 'page', 'post' );
		foreach($types as $type) {
			add_meta_box( 'default_meta', __( '<h3>' . 'Default Template Options &amp; Content'
			                                  . '</h3>',
				'chris-default-textdomain' ), 'chris_default_meta_callback', $type, 'normal', 'high' );
		}
	}
	//}
}
add_action( 'add_meta_boxes', 'chris_custom_default_meta' );

// Outputs the content of the meta box.
function chris_default_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'default_nonce' );
	$sbm_stored_default_meta = get_post_meta( $post->ID );
	?>
	<!-- CTA content -->
	<strong><label for="default-cta-content" class="default-row-title"><?php _e( 'CTA Content - After ',
				'chris-default-textdomain' )?></label></strong>
	<textarea style="width: 100%;" rows="4" name="default-cta-content" id="default-cta-content"><?php if ( isset ( $sbm_stored_default_meta['default-cta-content'] ) ) echo $sbm_stored_default_meta['default-cta-content'][0]; ?></textarea>

<?php }
