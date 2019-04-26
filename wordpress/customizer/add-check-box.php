<?php
/*
 * Adds a check box to customizer. Can be used conditionally.
 */

$wp_customize->add_setting( 'adds_checkbox', array(
'capability' => 'edit_theme_options',
'type'       => 'theme_mod',
'sanitize_callback' => 'themeslug_sanitize_checkbox',
) );

$wp_customize->add_control( 'adds_checkbox', array(
'type' => 'checkbox',
'section' => 'custom_section',
'label' => __( 'Some Checkbox' ),
'description' => __( 'This checkbox can be used to activate something.' ),
) );


// Here's the boolean check for your theme.
if( get_theme_mod( 'adds_checkbox' ) == '') { ?>
    <!-- add your stuff here -->
<?php } ?>