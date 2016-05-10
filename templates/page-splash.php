<?php /*
    Template Name: Splash
    */

    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    $image_url = get_template_directory_uri().'/dist/images/'.($subtheme === 'default' ? '':$subtheme.'/').'splash.svg';
    if (!file_exists($image_url)) {
		$image_url = str_replace('.svg', '.png', $image_url);
    }
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="block-main-container">
        <section class="block block-main">
            <section class="splash-container">
                <img src="<?= $image_url ?>" alt="splash-image" />
                <div class="splash-tagline">On nourrit votre dépendance à l'innovation</div>
            </section>
            <section class="main-content">
                <div class="main-description"><?php the_content(); ?></div>
                <div class="main-columns">
                    <ul class="list-items">
                        <?php while( have_rows('list') ): the_row();
                            $label = get_sub_field('label');
                            $icon = get_sub_field('icon');
                        ?>
                        <li class="list-item">
                            <?php if( $icon ): ?>
                                <img class="icon style-svg" src="<?php echo $icon['url']; ?>" />
                            <?php endif; ?>
                            <?php if( $label ): ?>
                                <div class="label"><?php echo $label; ?></div>
                            <?php endif; ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </section>
        </section>
        <section class="block-main-footer">
            <span>Organisé par [logo]</span>
            <span>[logo] Présenté par</span>
        </section>
    </div>
<?php endwhile; ?>
