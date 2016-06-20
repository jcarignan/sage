<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;
use Roots\Sage\Extras;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('immersiveproductions', get_template_directory() . '/languages');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'immersiveproductions'),
    'secondary_navigation' => __('Secondary Navigation', 'immersiveproductions'),
    'tertiary_navigation' => __('Tertiary Navigation', 'immersiveproductions')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));

  add_filter('show_admin_bar', '__return_false');
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  /*register_sidebar([
    'name'          => __('Primary', 'immersiveproductions'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
]);*/

  register_sidebar([
    'name'          => __('Footer', 'immersiveproductions'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_page()
  ]);

  return apply_filters('sage/display_sidebar', $display);
}



/**
 * Theme assets
 */
function assets() {
  // load fonts
  wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Noto+Sans:400,700');
  wp_enqueue_style( 'googleFonts');

  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  // conflicts with acf (loads before plugin's jQuery without jquery plugins)
  if(!is_admin()){
      wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);

      if (is_page('billeterie'))
      {
          $ticketStatus = Extras\get_ticket_status();
          wp_localize_script('sage/js', 'ticketsData', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'unique_id_nonce' ),
            'price' => $ticketStatus['price'],
            'comboPrice' => $ticketStatus['combo_price'],
            'comboCount' => $ticketStatus['combo_count']
          ));
      } else if (is_page('guestlist'))
      {
          wp_localize_script('sage/js', 'guestlistData', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'unique_id_nonce' )
          ));
      }
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);


/**
 * Head meta
 */

function add_head_meta() {
    $lang = 'fr';
    if(function_exists('qtrans_getLanguage'))
    {
        $lang = qtrans_getLanguage();
    }
    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    $image_path = '/dist/images/'.($subtheme === 'default' ? '':$subtheme.'/').'splash-'.$lang.'.png';
    $image_url = get_template_directory_uri().$image_path;

	echo '<meta name="description" content="'.get_option('meta_description').'" />';
	echo '<meta name="keywords" content="'.get_option('meta_keywords').'" />';
    echo '<meta property="og:url" content="'.get_home_url().'/" />';
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:title" content="'.get_bloginfo().'" />';
    echo '<meta property="og:description" content="'.get_option('meta_description').'" />';
    echo '<meta property="og:image" content="'.$image_url.'" />';
    echo "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){";
	echo "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),";
    echo "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)";
    echo "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');";
	echo "ga('create', '".get_option("google_analytics_code")."', 'auto');";
	echo "ga('send', 'pageview');";
	echo "</script>";
}

add_action( 'wp_head', __NAMESPACE__ . '\\add_head_meta' );

/**
 * Add SEO Settings
 */

function add_seo_settings() {
    add_settings_section(
        'seo_settings',
        'SEO',
        __NAMESPACE__ . '\\seo_callback',
        'general'
    );

    add_settings_field(
        'meta_description',
        'Meta description',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'seo_settings',
        array(
            'meta_description'
        )
    );

    add_settings_field(
        'meta_keywords',
        'Meta keywords',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'seo_settings',
        array(
            'meta_keywords'
        )
    );

    add_settings_field(
        'google_analytics_code',
        'Google analytics code',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'seo_settings',
        array(
            'google_analytics_code'
        )
    );

    register_setting('general','meta_description', 'esc_attr');
    register_setting('general','meta_keywords', 'esc_attr');
    register_setting('general','google_analytics_code', 'esc_attr');
}

/**
 * Add Mail Settings
 */

function add_mail_settings() {
    add_settings_section(
        'mail_settings',
        'Email settings',
        __NAMESPACE__ . '\\mail_callback',
        'general'
    );

    add_settings_field(
        'from_email',
        'From email',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'mail_settings',
        array(
            'from_email'
        )
    );

    add_settings_field(
        'from_name',
        'From name',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'mail_settings',
        array(
            'from_name'
        )
    );

    register_setting('general','from_email', 'esc_attr');
    register_setting('general','from_name', 'esc_attr');
}

function set_mail_from($old) {
    $email = get_option('from_email');
    return $email;
}

function set_mail_from_name($old) {
    $name = get_option('from_name');
    if(function_exists('qtrans_getLanguage'))
    {
        $name = qtranxf_use(qtranxf_getLanguage(), $name);
    }
    return $name;
}


/**
 * Add Ticket settings
 */

function add_ticket_settings() {
    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    if ($subtheme === 'default')
    {
        return;
    }

    add_settings_section(
        'ticket_settings',
        'Tickets Settings',
        __NAMESPACE__ . '\\ticket_callback',
        'general'
    );

    add_settings_field(
        'ticket_sandboxed',
        'Use sandboxed paypal environment',
        __NAMESPACE__ . '\\checkbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_sandboxed'
        )
    );

    add_settings_field(
        'ticket_name',//
        'Ticket name',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'ticket_settings',
        array(
            'ticket_name'
        )
    );

    // --- PROMO ---

    add_settings_field(
        'ticket_promo_label',
        'Promo label',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'ticket_settings',
        array(
            'ticket_promo_label'
        )
    );

    add_settings_field(
        'ticket_promo_price',
        'Promo price',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_promo_price'
        )
    );

    add_settings_field(
        'ticket_promo_button_id',
        'Promo paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_promo_button_id'
        )
    );

    add_settings_field(
        'ticket_promo_sandboxed_button_id',
        'Promo sandboxed paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_promo_sandboxed_button_id'
        )
    );

    add_settings_field(
        'ticket_promo_count',
        'Promo tickets count',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_promo_count'
        )
    );

    // --- EARLY ---

    add_settings_field(
        'ticket_early_label',
        'Early label',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'ticket_settings',
        array(
            'ticket_early_label'
        )
    );

    add_settings_field(
        'ticket_early_price',
        'Early price',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_early_price'
        )
    );

    add_settings_field(
        'ticket_early_button_id',
        'Early paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_early_button_id'
        )
    );

    add_settings_field(
        'ticket_early_sandboxed_button_id',
        'Early sandboxed paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_early_sandboxed_button_id'
        )
    );

    // --- NORMAL ---

    add_settings_field(
        'ticket_normal_label',
        'Normal label',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'ticket_settings',
        array(
            'ticket_normal_label'
        )
    );

    add_settings_field(
        'ticket_normal_price',
        'Normal price',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_normal_price'
        )
    );

    add_settings_field(
        'ticket_normal_button_id',
        'Normal paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_normal_button_id'
        )
    );

    add_settings_field(
        'ticket_normal_sandboxed_button_id',
        'Normal sandboxed paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_normal_sandboxed_button_id'
        )
    );

    add_settings_field(
        'ticket_normal_price_start_date',
        'Normal price start date',
        __NAMESPACE__ . '\\date_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_normal_price_start_date'
        )
    );

    // --- COMBO ---

    add_settings_field(
        'ticket_combo_label',
        'Combo label',
        __NAMESPACE__ . '\\textbox_callback_qtranslate',
        'general',
        'ticket_settings',
        array(
            'ticket_combo_label'
        )
    );

    add_settings_field(
        'ticket_combo_price',
        'Combo price',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_combo_price'
        )
    );

    add_settings_field(
        'ticket_combo_button_id',
        'Combo paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_combo_button_id'
        )
    );

    add_settings_field(
        'ticket_combo_sandboxed_button_id',
        'Combo sandboxed paypal button ID',
        __NAMESPACE__ . '\\textbox_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_combo_sandboxed_button_id'
        )
    );

    add_settings_field(
        'ticket_combo_count',
        'Combo count',
        __NAMESPACE__ . '\\number_callback',
        'general',
        'ticket_settings',
        array(
            'ticket_combo_count'
        )
    );

    register_setting('general','ticket_sandboxed', 'esc_attr');
    register_setting('general','ticket_name', 'esc_attr');

    register_setting('general','ticket_promo_label', 'esc_attr');
    register_setting('general','ticket_promo_price', 'esc_attr');
    register_setting('general','ticket_promo_button_id', 'esc_attr');
    register_setting('general','ticket_promo_sandboxed_button_id', 'esc_attr');
    register_setting('general','ticket_promo_count', 'esc_attr');

    register_setting('general','ticket_early_label', 'esc_attr');
    register_setting('general','ticket_early_price', 'esc_attr');
    register_setting('general','ticket_early_button_id', 'esc_attr');
    register_setting('general','ticket_early_sandboxed_button_id', 'esc_attr');

    register_setting('general','ticket_normal_label', 'esc_attr');
    register_setting('general','ticket_normal_price', 'esc_attr');
    register_setting('general','ticket_normal_button_id', 'esc_attr');
    register_setting('general','ticket_normal_sandboxed_button_id', 'esc_attr');
    register_setting('general','ticket_normal_price_start_date', 'esc_attr');

    register_setting('general','ticket_combo_label', 'esc_attr');
    register_setting('general','ticket_combo_price', 'esc_attr');
    register_setting('general','ticket_combo_button_id', 'esc_attr');
    register_setting('general','ticket_combo_sandboxed_button_id', 'esc_attr');
    register_setting('general','ticket_combo_count', 'esc_attr');
}

function seo_callback() {

}

function mail_callback() {

}

function ticket_callback() {

}

function checkbox_callback($args) {
    $option = get_option($args[0]);
    echo '<input type="checkbox" id="'. $args[0] .'" name="'. $args[0] .'" value="1" '.checked('1', $option, false).'" />';
}

function textbox_callback($args) {
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function date_callback($args) {
    $option = get_option($args[0]);
    echo '<input type="date" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

function textbox_callback_qtranslate($args) {
    $option = get_option($args[0]);
    echo '<input class="regular-text qtranxs-translatable" type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
    /*
    echo '<input name="qtranslate-fields['.$args[0].'][fr]" type="hidden" class="hidden" value="'.$option.'" />';
    echo '<input name="qtranslate-fields['.$args[0].'][en]" type="hidden" class="hidden" value="'.$option.'"/>';
    echo '<input name="qtranslate-fields['.$args[0].'][qtranslate-separator]" type="hidden" class="hidden" value="["/>';
    echo '<input name="'.$args[0].'" type="text" id="'.$args[0].'" value="'.$option.'" class="regular-text qtranxs-translatable"/>';*/
}

function number_callback($args) {
    $option = get_option($args[0]);
    echo '<input type="number" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}


add_action('admin_init',  __NAMESPACE__ . '\\add_seo_settings' );
add_action('admin_init',  __NAMESPACE__ . '\\add_mail_settings' );
add_action('admin_init',  __NAMESPACE__ . '\\add_ticket_settings' );
add_filter('wp_mail_from', __NAMESPACE__ . '\\set_mail_from');
add_filter('wp_mail_from_name', __NAMESPACE__ . '\\set_mail_from_name');
