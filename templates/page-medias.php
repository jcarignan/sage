<?php /*
    Template Name: Medias
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="independant-scrollable">
        <div class="scrollable-content content-press">
            <?php
                the_content();
                $args = array(
                  'post_type' => 'press-article',
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'caller_get_posts'=> 1,
                  'order' => 'asc',
                  'order_by' => 'meta_value',
                  'meta_key' => 'date'
                );

                $query = new WP_Query($args);
                if( $query->have_posts() ) {
                  while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="press-article">
                        <p><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                        <p><?php the_content(); ?></p>
                        <p><?php the_field('date'); ?></p>
                        <a href="<?php the_field('link'); ?>">Link</a>
                    </div>
                    <?php
                  endwhile;
                }
                wp_reset_query();
            ?>
        </div>

    <?php if ($images = get_field('gallery')): ?>
        <div class="scrollable-content content-gallery">
            <ul>
                <?php foreach( $images as $image ): ?>
                    <li>
                        <a href="<?php echo $image['url']; ?>">
                             <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                        </a>
                        <p><?php echo $image['caption']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    </div>
<?php endwhile; ?>
