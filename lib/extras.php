<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'immersiveproductions') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * TICKETS
 */

function get_ticket_status() {
    global $wpdb;
    $price;
    $comboPrice;
    $comboActive = false;
    $comboCount = get_option('ticket_combo_count');
    $promoCount = get_option('ticket_promo_count');
    $normalPriceStartDate = get_option('ticket_normal_price_start_date');
    $timeUntilNormalPrice = strtotime($normalPriceStartDate) - current_time('timestamp');

    $tickets_sold = $wpdb->get_var("SELECT COUNT(*) FROM wp_tickets WHERE `paid` = 1");
    $promoActive = $tickets_sold < $promoCount;
    $earlyActive = $timeUntilNormalPrice > 0;

    if ($promoActive)
    {
        $price = $comboPrice = get_option('ticket_promo_price');
    } else {
        if ($earlyActive){
            $price = get_option('ticket_early_price');
        } else {
            $price = get_option('ticket_normal_price');
        }
        $comboPrice = get_option('ticket_combo_price');
    }
    return array(
        'tickets_sold' => $tickets_sold,
        'price'=> $price,
        'promo_active' => $promoActive,
        'early_active' => $earlyActive,
        'combo_price' => $comboPrice,
        'combo_count' => $comboCount,
        'promo_count' => $promoCount,
        'labels' => array(
            'ticket' => get_option('ticket_name'),
            'promo' => get_option('ticket_promo_label'),
            'early' => get_option('ticket_early_label'),
            'normal' => get_option('ticket_normal_label'),
            'combo' => get_option('ticket_combo_label')
        )
    );
}

function add_currency_to_price($price) {
    return function_exists('qtrans_getLanguage') && qtrans_getLanguage() == 'fr' ? $price.'$':'$'.$price;
}

function get_current_price(){
    $ticketStatus = get_ticket_status();
    return add_currency_to_price($ticketStatus['price']);
}

function get_combo_price(){
    $ticketStatus = get_ticket_status();
	return add_currency_to_price($ticketStatus['combo_price']);
}

function get_promo_count(){
    $ticketStatus = get_ticket_status();
	return $ticketStatus['promo_count'];
}

function on_paypal_payment_completed($posted) {

    // Parse data from IPN $posted array

    $mc_gross = isset($posted['mc_gross']) ? $posted['mc_gross'] : '';
    $invoice = isset($posted['invoice']) ? $posted['invoice'] : '';
    $protection_eligibility = isset($posted['protection_eligibility']) ? $posted['protection_eligibility'] : '';
    $address_status = isset($posted['address_status']) ? $posted['address_status'] : '';
    $payer_id = isset($posted['payer_id']) ? $posted['payer_id'] : '';
    $tax = isset($posted['tax']) ? $posted['tax'] : '';
    $address_street = isset($posted['address_street']) ? $posted['address_street'] : '';
    $payment_date = isset($posted['payment_date']) ? $posted['payment_date'] : '';
    $payment_status = isset($posted['payment_status']) ? $posted['payment_status'] : '';
    $charset = isset($posted['charset']) ? $posted['charset'] : '';
    $address_zip = isset($posted['address_zip']) ? $posted['address_zip'] : '';
    $mc_shipping = isset($posted['mc_shipping']) ? $posted['mc_shipping'] : '';
    $mc_handling = isset($posted['mc_handling']) ? $posted['mc_handling'] : '';
    $first_name = isset($posted['first_name']) ? $posted['first_name'] : '';
    $address_country_code = isset($posted['address_country_code']) ? $posted['address_country_code'] : '';
    $address_name = isset($posted['address_name']) ? $posted['address_name'] : '';
    $notify_version = isset($posted['notify_version']) ? $posted['notify_version'] : '';
    $payer_status = isset($posted['payer_status']) ? $posted['payer_status'] : '';
    $business = isset($posted['business']) ? $posted['business'] : '';
    $address_country = isset($posted['address_country']) ? $posted['address_country'] : '';
    $num_cart_items = isset($posted['num_cart_items']) ? $posted['num_cart_items'] : '';
    $mc_handling1 = isset($posted['mc_handling1']) ? $posted['mc_handling1'] : '';
    $address_city = isset($posted['address_city']) ? $posted['address_city'] : '';
    $verify_sign = isset($posted['verify_sign']) ? $posted['verify_sign'] : '';
    $payer_email = isset($posted['payer_email']) ? $posted['payer_email'] : '';
    $mc_shipping1 = isset($posted['mc_shipping1']) ? $posted['mc_shipping1'] : '';
    $tax1 = isset($posted['tax1']) ? $posted['tax1'] : '';
    $txn_id = isset($posted['txn_id']) ? $posted['txn_id'] : '';
    $payment_type = isset($posted['payment_type']) ? $posted['payment_type'] : '';
    $last_name = isset($posted['last_name']) ? $posted['last_name'] : '';
    $receiver_email = isset($posted['receiver_email']) ? $posted['receiver_email'] : '';
    $quantity1 = isset($posted['quantity1']) ? $posted['quantity1'] : '';
    $receiver_id = isset($posted['receiver_id']) ? $posted['receiver_id'] : '';
    $receipt_id = isset($posted['receipt_id']) ? $posted['receipt_id'] : '';
    $ipn_track_id = isset($posted['ipn_track_id']) ? $posted['ipn_track_id'] : '';
    $IPN_status = isset($posted['IPN_status']) ? $posted['IPN_status'] : '';
    $cart_items = isset($posted['cart_items']) ? $posted['cart_items'] : '';
    $invoice = isset($posted['invoice']) ? $posted['invoice'] : '';

    /**
    * At this point you can use the data to generate email notifications,
    * update your local database, hit 3rd party web services, or anything
    * else you might want to automate based on this type of IPN.
    */

    global $wpdb;
    $wpdb->update(
    	'wp_tickets',
    	array(
    		'paid' => 1,
            'paid_date' => current_time('mysql')
    	),
    	array('invoice' => $invoice),
    	array(
    		'%d',
    		'%s'
    	),
    	array('%s')
    );

    // select all where invoice = invoice

    $message = 'allo '.$invoice;
    $headers = '';//'From: '. $fullname .' <'. $email .'>' . "\r\n";

    wp_mail('maxjub@hotmail.com', 'ton billet', $message, $headers);
}
add_action('paypal_ipn_for_wordpress_payment_status_completed',  __NAMESPACE__ . '\\on_paypal_payment_completed', 10, 1);

function create_ticket_and_pay() {
    global $wpdb;
    $invoice = md5(uniqid());
    $quantity = $_POST['quantity'];
    $ticketStatus = get_ticket_status();
    $price = $ticketStatus['price'];
    $itemName;
    if ($ticketStatus['promo_active'])
    {
        $buttonID = get_option('ticket_promo_button_id');
        $itemName = $ticketStatus['labels']['promo'];
    } else {
        if ($quantity < $ticketStatus['combo_count'])
        {
            if ($ticketStatus['early_active']){
                $buttonID = get_option('ticket_early_button_id');
                $itemName = $ticketStatus['labels']['early'];
            } else {
                $buttonID = get_option('ticket_normal_button_id');
                $itemName = $ticketStatus['labels']['normal'];
            }
        } else {
            $buttonID = get_option('ticket_combo_button_id');
            $itemName = $ticketStatus['labels']['combo'];
            $price = $ticketStatus['combo_price'];
        }
    }
    $itemName = qtranxf_use(qtranxf_getLanguage(), $itemName);
    $ticketName = qtranxf_use(qtranxf_getLanguage(), $ticketStatus['labels']['ticket']);
    $paypalUrl;
    if (get_option('ticket_sandboxed') == 1 ){
        $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    } else {
        $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';
    }

    for ($i = 0; $i < $quantity;$i++)
    {
        $wpdb->insert('wp_tickets', array(
            'first_name' => $_POST['firstname_'.$i],
            'last_name' => $_POST['lastname_'.$i],
            'entreprise' => $_POST['entreprise_'.$i],
            'title' => $_POST['title_'.$i],
            'email' => $_POST['email_'.$i],
            'telephone' => $_POST['telephone_'.$i],
            'price' => $price,
            'item_name' => $itemName,
            'invoice' => $invoice,
            'qr_code' => md5(uniqid())
        ), array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s'
        ));
    }

    echo json_encode(array(
        'paypal_url' => $paypalUrl,
        'fields' => array(
            'hosted_button_id' => $buttonID,
            'quantity' => $quantity,
            'invoice' => $invoice,
            'item_name' => $ticketName.' - '.$itemName,
            'notify_url' => home_url().'/?AngellEYE_Paypal_Ipn_For_Wordpress&action=ipn_handler',
            'return' =>  home_url().'/merci/?invoice='.$invoice,
            'cancel_return' =>  home_url().'/billeterie/',
            'rm' =>  2,
            'undefined_ quantity' =>  1,
            'cmd' =>  '_s-xclick',
            'lc' =>  'CA',
            'charset' => 'utf-8',
            'no_note' => '1'
        )
    ));
    wp_die();
}

add_action('wp_ajax_create_ticket_and_pay', __NAMESPACE__ .'\\create_ticket_and_pay');
add_action('wp_ajax_nopriv_create_ticket_and_pay', __NAMESPACE__ .'\\create_ticket_and_pay');
add_shortcode('current_price', __NAMESPACE__ . '\\get_current_price');
add_shortcode('tickets_promo_count', __NAMESPACE__ . '\\get_promo_count');
