<?php
$wp_customize->add_setting( 'basic_text_bawx', array(
	'capability' => 'edit_theme_options',
	'default' => 'Smooth content. Dripping goodness.',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'basic_text_bawx', array(
	'type' => 'text',
	'section' => 'your_custom_bitch_ass_section',
	'label' => __( 'It will put the text here.' ),
	'description' => __( 'Or it gets the hose.' ),
) );
