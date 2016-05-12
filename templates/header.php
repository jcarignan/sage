<?php
    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    $image_path = '/dist/images/'.($subtheme === 'default' ? '':$subtheme.'/').'logo.svg';
    $image_location = get_template_directory().$image_path;
    $image_url = get_template_directory_uri().$image_path;

    if (!file_exists($image_location)) {
		$image_url = str_replace('.svg', '.png', $image_url);
    }
?>

<header class="banner">
    <a class="brand" href="<?= esc_url(home_url('/'));?>"><img src="<?=$image_url?>" alt="<?php bloginfo('name'); ?>" /></a>
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
