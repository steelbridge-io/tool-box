<?php
/**
 * Created by PhpStorm.
 * User: chrisparsons
 * Date: 2019-03-06
 * Time: 00:12
 */

// Allows the setting of a default payment source
add_action( 'woocommerce_before_checkout_form', 'action_before_checkout_form' );
function action_before_checkout_form(){
	// HERE define the default payment gateway ID
	$default_payment_gateway_id = 'stripe';

	WC()->session->set('chosen_payment_method', $default_payment_gateway_id);
}