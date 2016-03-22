<?php /*
    Template Name: Clients
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="independant-scrollable">
        <div class="scrollable-content content-clients">
            <?php
                the_content();
                $args = array(
                  'post_type' => 'client',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'caller_get_posts'=> 1,
                  'order' => 'asc',
                  'order_by' => 'menu_order'
                );

                $query = new WP_Query($args);
                if( $query->have_posts() ) {
                  while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="client">
                        <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                        <p><?php the_content(); ?></p>
                    </div>
                    <?php
                  endwhile;
                }
                wp_reset_query();
            ?>
        </div>
        <div class="scrollable-content content-feedbacks">
            <?php
                the_content();
                $args = array(
                  'post_type' => 'feedback',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'caller_get_posts'=> 1,
                  'order' => 'asc',
                  'order_by' => 'menu_order'
                );

                $query = new WP_Query($args);
                if( $query->have_posts() ) {
                  while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="feedback">
                        <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                        <p><?php the_content(); ?></p>
                    </div>
                    <?php
                  endwhile;
                }
                wp_reset_query();
            ?>
        </div>
    </div>
<?php endwhile; ?>
