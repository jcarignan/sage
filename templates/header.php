<header class="banner">
    <a class="brand" href="<?= esc_url(home_url('/'));?>"><img src="<?php echo get_template_directory_uri().'/dist/images/logo.png';?>" alt="<?php bloginfo('name'); ?>" /></a>
    <div class="header-content">
        <?php if (has_nav_menu('primary_navigation')) : ?>
            <nav class="nav-primary">
                <?php wp_nav_menu(['theme_location' => 'primary_navigation']); ?>
            </nav>
        <?php endif; ?>
        <?php if (has_nav_menu('secondary_navigation')) :  ?>
            <nav class="nav-secondary">
                <span class="admin-url"><?php wp_loginout(get_permalink()); ?></span>
                <?php wp_nav_menu(['theme_location' => 'secondary_navigation']); ?>
            </nav>
        <?php endif; ?>
        <?php if (has_nav_menu('tertiary_navigation')) : ?>
            <nav class="nav-tertiary">
                <?php wp_nav_menu(['theme_location' => 'tertiary_navigation']); ?>
            </nav>
        <?php endif; ?>
        <a class="hamburger" href="#"></a>
    </div>
</header>
