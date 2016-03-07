<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <div class="right-content">
      <?php
      if (has_nav_menu('top_right')) :
        wp_nav_menu(['theme_location' => 'top_right', 'menu_class' => 'nav']);
      endif;
      if (has_nav_menu('social_medias')) :
        wp_nav_menu(['theme_location' => 'social_medias', 'menu_class' => 'nav']);
      endif;
      ?>
    </div>
  </div>
</header>
