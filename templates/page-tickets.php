<?php /*
    Template Name: Tickets
    */
?>

<?php while (have_posts()) : the_post();
    //$image = get_field('image');
    //$tagline = get_field('tagline');
?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <div class="content-description"><?php the_content(); ?></div>
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
    </div>
<?php endwhile; ?>
