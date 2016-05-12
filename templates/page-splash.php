<?php /*
    Template Name: Splash
    */

    $subtheme = get_option( 'immersiveproductions_theme_options')['subtheme'];
    
    $image_path = '/dist/images/'.($subtheme === 'default' ? '':$subtheme.'/').'splash.svg';
    $image_location = get_template_directory().$image_path;
    $image_url = get_template_directory_uri().$image_path;

    if (!file_exists($image_location)) {
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
            </section>
        </section>
        <section class="block-main-footer">
            <ul class="list-items">
                <?php while( have_rows('list_footer') ): the_row();
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
        </section>
    </div>
<?php endwhile; ?>
