<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

$theme_options = get_option( 'immersiveproductions_theme_options');
$subtheme = $theme_options['subtheme'];

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class('subtheme-'.$subtheme); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'immersiveproductions'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="content hidden" role="document">
        <main class="main">
            <h1 class="site-name"><?=get_bloginfo();?></h1>
            <h2 class="page-title"><?=get_the_title();?></h2>
          <?php include Wrapper\template_path(); ?>
          <?php
            do_action('get_footer');
            get_template_part('templates/footer');
            wp_footer();
          ?>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

    </div><!-- /.content -->

  </body>
</html>
