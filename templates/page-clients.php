<?php /*
    Template Name: Clients
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="scrollable-container">
        <div class="scrollable-content content-gallery">
            <?php echo do_shortcode('[wp-tiles grids="clients" small_screen_grid="clients-mobile" breakpoint="493" padding="10" byline_height_auto="true" post_type="client" order="asc" orderby="menu_order"]'); ?>
        </div>
        <div class="scrollable-content content-list">
            <div class="page-header"><h1><?php the_content(); ?></h1></div>
            <?php
                $args = array(
                  'post_type' => 'feedback',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'caller_get_posts'=> 1,
                  'order' => 'ASC',
                  'orderby' => 'menu_order'
                );

                $query = new WP_Query($args);
                if( $query->have_posts() ):
            ?>
                    <ul class="feedbacks">
                        <?php  while ($query->have_posts()) : $query->the_post(); ?>
                        <li class="feedback">
                            <h4><?php the_title(); ?></h4>
                            <p><?php the_content(); ?></p>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
<?php endwhile; ?>
