<?php /*
    Template Name: Medias
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="two-columns-scrollable">
        <ul class="scrollable-nav">
            <?php if($mediasLabel = get_field( "medias_label" )): ?>
                <li class="scrollable-nav-item active"><a href="#" data-scrollable-classname="content-gallery"><?= $mediasLabel ?></a></li>
            <?php endif; ?>
            <?php if($pressLabel = get_field( "press_label" )): ?>
                <li class="scrollable-nav-item"><a href="#" data-scrollable-classname="content-press"><?= $pressLabel ?></a></li>
            <?php endif; ?>
        </ul>
        <div class="scrollable-container">
            <?php if ($images = get_field('gallery')): ?>
            <div class="scrollable-content content-gallery active">
                <ul>
                    <?php foreach( $images as $image ): ?>
                        <li>
                            <a href="<?php echo $image['url']; ?>" rel="lightbox">
                                 <div style="background-image: url(<?php echo $image['sizes']['medium']; ?>);"></div>
                            </a>
                            <p><?php echo $image['caption']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="scrollable-content content-press">
                <?php if($pressLabel = get_field( "press_label" )): ?>
                    <div class="page-header"><h1><?= $pressLabel ?></h1></div>
                <?php endif; ?>
                <?php $args = array(
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
                            <a href="<?php the_field('link'); ?>" target="_blank">
                                <?php if (has_post_thumbnail(get_the_ID() ) ): ?>
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
                                    <img src="<?php echo $image[0]; ?>" />
                                <?php endif; ?>
                                <div class="link-infos">
                                    <div class="names">
                                        <h3><?php the_title(); ?></h3>
                                        <h4><?php the_content(); ?></h4>
                                    </div>
                                    <div class="date">
                                        <?php the_field('date'); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                      endwhile;
                    }
                    wp_reset_query();
                ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
