<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->add_section('immersiveproductions_subtheme', array(
      'title'    => __('Sub-theme', 'immersiveproductions'),
      'priority' => 120,
  ));

  $wp_customize->add_setting('immersiveproductions_theme_options[subtheme]',  array(
    'default'        => 'Immersive productions',
    'capability'     => 'edit_theme_options',
    'type'           => 'option'
  ));

  $wp_customize->add_control('subtheme', array(
        'label'      => __('Sub-theme', 'immersiveproductions'),
        'section'    => 'immersiveproductions_subtheme',
        'settings'   => 'immersiveproductions_theme_options[subtheme]',
        'type'       => 'radio',
        'choices'    => array(
            'default' => 'Immersive productions',
            'accro' => 'Accro'
        )
    ));
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
