<?php /*
    Template Name: Splash
    */
?>

<?php while (have_posts()) : the_post();
    $image = get_field('image');
    $tagline = get_field('tagline');
    $link = get_field('link');
?>
    <div class="block-main-container">
        <section class="block block-main">
            <section class="splash-container">
                <a href="<?=$link?>">
                    <img src="<?= $image['url'] ?>" alt="splash-image" />
                    <div class="splash-tagline"><?=$tagline?></div>
                </a>
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
                            <div class="label"><?php echo do_shortcode($label); ?></div>
                        <?php endif; ?>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </section>
    </div>
<?php endwhile; ?>
