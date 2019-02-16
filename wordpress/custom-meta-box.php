<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-02-15
 * Time: 19:18
 */

/**
 * Adds a meta box to the post editing screen
 */
function chris_custom_meta() {
    add_meta_box( 'chris_meta', __( 'Meta Box Title', 'chris-textdomain' ), 'chris_meta_callback', 'post' );
}
add_action( 'add_meta_boxes', 'chris_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function chris_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'chris_nonce' );
    $chris_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <label for="meta-text" class="chris-row-title"><?php _e( 'Example Text Input', 'chris-textdomain' )?></label>
        <input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $chris_stored_meta['meta-text'] ) ) echo $chris_stored_meta['meta-text'][0]; ?>" />
    </p>

    <p>
        <span class="chris-row-title"><?php _e( 'Example Checkbox Input', 'chris-textdomain' )?></span>
    <div class="chris-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $chris_stored_meta['meta-checkbox'] ) ) checked( $chris_stored_meta['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Checkbox label', 'chris-textdomain' )?>
        </label>
        <label for="meta-checkbox-two">
            <input type="checkbox" name="meta-checkbox-two" id="meta-checkbox-two" value="yes" <?php if ( isset ( $chris_stored_meta['meta-checkbox-two'] ) ) checked( $chris_stored_meta['meta-checkbox-two'][0], 'yes' ); ?> />
            <?php _e( 'Another checkbox', 'chris-textdomain' )?>
        </label>
    </div>
    </p>

    <p>
        <span class="chris-row-title"><?php _e( 'Example Radio Buttons', 'chris-textdomain' )?></span>
    <div class="chris-row-content">
        <label for="meta-radio-one">
            <input type="radio" name="meta-radio" id="meta-radio-one" value="radio-one" <?php if ( isset ( $chris_stored_meta['meta-radio'] ) ) checked( $chris_stored_meta['meta-radio'][0], 'radio-one' ); ?>>
            <?php _e( 'Radio Option #1', 'chris-textdomain' )?>
        </label>
        <label for="meta-radio-two">
            <input type="radio" name="meta-radio" id="meta-radio-two" value="radio-two" <?php if ( isset ( $chris_stored_meta['meta-radio'] ) ) checked( $chris_stored_meta['meta-radio'][0], 'radio-two' ); ?>>
            <?php _e( 'Radio Option #2', 'chris-textdomain' )?>
        </label>
    </div>
    </p>

    <p>
        <label for="meta-select" class="chris-row-title"><?php _e( 'Example Select Input', 'chris-textdomain' )?></label>
        <select name="meta-select" id="meta-select">
            <option value="select-one" <?php if ( isset ( $chris_stored_meta['meta-select'] ) ) selected( $chris_stored_meta['meta-select'][0], 'select-one' ); ?>><?php _e( 'One', 'chris-textdomain' )?></option>';
            <option value="select-two" <?php if ( isset ( $chris_stored_meta['meta-select'] ) ) selected( $chris_stored_meta['meta-select'][0], 'select-two' ); ?>><?php _e( 'Two', 'chris-textdomain' )?></option>';
        </select>
    </p>

    <p>
        <label for="meta-textarea" class="chris-row-title"><?php _e( 'Example Textarea Input', 'chris-textdomain' )?></label>
        <textarea name="meta-textarea" id="meta-textarea"><?php if ( isset ( $chris_stored_meta['meta-textarea'] ) ) echo $chris_stored_meta['meta-textarea'][0]; ?></textarea>
    </p>

    <p>
        <label for="meta-color" class="chris-row-title"><?php _e( 'Color Picker', 'chris-textdomain' )?></label>
        <input name="meta-color" type="text" value="<?php if ( isset ( $chris_stored_meta['meta-color'] ) ) echo $chris_stored_meta['meta-color'][0]; ?>" class="meta-color" />
    </p>

    <p>
        <label for="meta-image" class="chris-row-title"><?php _e( 'Example File Upload', 'chris-textdomain' )?></label>
        <input type="text" name="meta-image" id="meta-image" value="<?php if ( isset ( $chris_stored_meta['meta-image'] ) ) echo $chris_stored_meta['meta-image'][0]; ?>" />
        <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Choose or Upload an Image', 'chris-textdomain' )?>" />
    </p>


    <?php
}



/**
 * Saves the custom meta input
 */
function chris_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'chris_nonce' ] ) && wp_verify_nonce( $_POST[ 'chris_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'meta-text' ] ) ) {
        update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
    }

    // Checks for input and saves
    if( isset( $_POST[ 'meta-checkbox' ] ) ) {
        update_post_meta( $post_id, 'meta-checkbox', 'yes' );
    } else {
        update_post_meta( $post_id, 'meta-checkbox', '' );
    }

    // Checks for input and saves
    if( isset( $_POST[ 'meta-checkbox-two' ] ) ) {
        update_post_meta( $post_id, 'meta-checkbox-two', 'yes' );
    } else {
        update_post_meta( $post_id, 'meta-checkbox-two', '' );
    }

    // Checks for input and saves if needed
    if( isset( $_POST[ 'meta-radio' ] ) ) {
        update_post_meta( $post_id, 'meta-radio', $_POST[ 'meta-radio' ] );
    }

    // Checks for input and saves if needed
    if( isset( $_POST[ 'meta-select' ] ) ) {
        update_post_meta( $post_id, 'meta-select', $_POST[ 'meta-select' ] );
    }

    // Checks for input and saves if needed
    if( isset( $_POST[ 'meta-textarea' ] ) ) {
        update_post_meta( $post_id, 'meta-textarea', $_POST[ 'meta-textarea' ] );
    }

    // Checks for input and saves if needed
    if( isset( $_POST[ 'meta-color' ] ) ) {
        update_post_meta( $post_id, 'meta-color', $_POST[ 'meta-color' ] );
    }

    // Checks for input and saves if needed
    if( isset( $_POST[ 'meta-image' ] ) ) {
        update_post_meta( $post_id, 'meta-image', $_POST[ 'meta-image' ] );
    }

}
add_action( 'save_post', 'chris_meta_save' );


/**
 * Adds the meta box stylesheet when appropriate
 */
function chris_admin_styles(){
    global $typenow;
    if( $typenow == 'post' ) {
        wp_enqueue_style( 'chris_meta_box_styles', plugin_dir_url( __FILE__ ) . 'meta-box-styles.css' );
    }
}
add_action( 'admin_print_styles', 'chris_admin_styles' );


/**
 * Loads the color picker javascript
 */
function chris_color_enqueue() {
    global $typenow;
    if( $typenow == 'post' ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'meta-box-color-js', plugin_dir_url( __FILE__ ) . 'meta-box-color.js', array( 'wp-color-picker' ) );
    }
}
add_action( 'admin_enqueue_scripts', 'chris_color_enqueue' );

/**
 * Loads the image management javascript
 */
function chris_image_enqueue() {
    global $typenow;
    if( $typenow == 'post' ) {
        wp_enqueue_media();

        // Registers and enqueues the required javascript.
        wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Choose or Upload an Image', 'chris-textdomain' ),
                'button' => __( 'Use this image', 'chris-textdomain' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'chris_image_enqueue' );