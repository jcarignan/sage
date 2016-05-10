<?php
    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    $logo_url = get_template_directory_uri().'/dist/images/'.($subtheme === 'default' ? '':$subtheme.'/').'logo.svg';
    if (!file_exists($logo_url)) {
		$logo_url = str_replace('.svg', '.png', $logo_url);
    }
?>

<header class="banner">
    <a class="brand" href="<?= esc_url(home_url('/'));?>"><img src="<?=$logo_url?>" alt="<?php bloginfo('name'); ?>" /></a>
    <div class="header-content">
        <?php if (has_nav_menu('primary_navigation')) : ?>
            <nav class="nav-primary">
                <?php wp_nav_menu(['theme_location' => 'primary_navigation']); ?>
            </nav>
        <?php endif; ?>
        <?php if (has_nav_menu('secondary_navigation')) :  ?>
            <nav class="nav-secondary">
                <?php wp_nav_menu(['theme_location' => 'secondary_navigation']); ?>
            </nav>
        <?php endif; ?>
        <?php if (has_nav_menu('tertiary_navigation')) : ?>
            <nav class="nav-tertiary">
                <?php wp_nav_menu(['theme_location' => 'tertiary_navigation']); ?>
            </nav>
        <?php endif; ?>
    </div>
    <button type="button" class="hamburger"></button>
</header>
