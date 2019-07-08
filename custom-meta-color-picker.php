<?php

// Sanitize file.
include( plugin_dir_path( __FILE__ ) . '../inc/sanitize_file.php');

// Add the code below to your sanitize_file.php
add_action( 'save_post', 'meta_save' );
function meta_save( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'your_nonce' ] ) && wp_verify_nonce( $_POST[ 'your_nonce' ], basename(
		__FILE__ ) ) ) ? 'true' : 'false';

}

// Adds a meta box. This is an example.
function custom_meta() { global $post;
	if(!empty($post)) {
		// Associate with a template
		$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
		if($pageTemplate == 'page-templates/holiday-template.php') {

			// Associate with a post type
			$types = array('post', 'page', 'travel_cpt', 'schools_cpt', 'adventures', 'guide_service', 'fishcamp_cpt');
			foreach($types as $type) {
				add_meta_box( 'your_meta', __( 'Meta Box Title', 'your-textdomain' ), 'your_meta_callback', $type,
					'normal',	'high' );
			}
		}
	}
}
add_action( 'add_meta_boxes', 'custom_meta' );

// Adds the custom meta box content
function holiday_meta_callback( $post ) {
wp_nonce_field( basename( __FILE__ ), 'your_nonce' );
$holiday_stored_meta = get_post_meta( $post->ID );
ob_start();
?>

  <!-- === Meta Field Color Picker example as a row of three for different === -->
  <div id="holiday-template" class="holiday-meta-select text-center">
    <h2 class="admin-font">Holiday Template Custom Colors</h2>
    <div class="row mt-2618">
      <div class="col-lg-2">
        <div class="panel panel-default">
          <div class="panel-body text-center colorselector">

            <!-- Color Picker Example -->
            <label for="meta-carousel-bg-color" class="prfx-row-title"><?php _e( 'Carousel BG Color', 'holiday-textdomain' )
              ?></label>
            <input name="meta-carousel-bg-color" type="text" value="<?php if ( isset ( $holiday_stored_meta['meta-carousel-bg-color'] ) ) echo
            $holiday_stored_meta['meta-carousel-bg-color'][0]; ?>" class="meta-color" />
          </div>
        </div>
      </div>

      <div class="col-lg-2">
        <div class="panel panel-default">
          <div class="panel-body text-center colorselector">
            <label for="meta-grid-bg-color" class="prfx-row-title"><?php _e( 'Grid BG Color', 'holiday-textdomain' )
              ?></label>
            <input name="meta-grid-bg-color" type="text" value="<?php if ( isset ( $holiday_stored_meta['meta-grid-bg-color'])) echo $holiday_stored_meta['meta-grid-bg-color'][0]; ?>" class="meta-grid-bg-color">
          </div>
        </div>
      </div>

      <div class="col-lg-2">
        <div class="panel panel-default">
          <div class="panel-body text-center colorselector">
            <label for="meta-color-text" class="prfx-row-title"><?php _e( 'Text Color', 'holiday-textdomain' )?></label>
            <input name="meta-color-text" type="text" value="<?php if ( isset ( $holiday_stored_meta['meta-color-text'])) echo $holiday_stored_meta['meta-color-text'][0]; ?>" class="meta-color-text">
          </div>
        </div>
      </div>

    </div>

  <?php } ?>






