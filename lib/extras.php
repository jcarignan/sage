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
 * Shortcodes
 */
function get_current_price( $atts ){
    global $wpdb;
    $price;
    $tickets_bought = $wpdb->get_var("SELECT COUNT(*) FROM wp_tickets WHERE `paid` = 1");
    $normalPriceStartDate = get_option('ticket_normal_price_start_date');
    $timeUntilNormalPrice = strtotime($normalPriceStartDate) - current_time('timestamp');
    if ($tickets_bought < get_option('ticket_promo_count'))
    {
        $price = get_option('ticket_promo_price');
    } else if ($timeUntilNormalPrice > 0){
        $price = get_option('ticket_early_price');
    } else {
        $price = get_option('ticket_normal_price');
    }
	return $price;
}
add_shortcode('current_price', __NAMESPACE__ . '\\get_current_price');
