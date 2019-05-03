<?php
$wp_customize->add_setting( 'precious_text_bawx', array(
	'capability' => 'edit_theme_options',
	'default' => 'Put the fucking text in the input.',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'precious_text_bawx', array(
	'type' => 'text',
	'section' => 'great_big_fat_section',
	'label' => __( 'It puts the text here. It does this whenever it is told.' ),
	'description' => __( 'Or it will get the hose.' ),
) );
