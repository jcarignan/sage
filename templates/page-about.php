<?php /*
    Template Name: About
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <section class="block block-main">
        <section class="block-content content-description">
            <?php get_template_part('templates/page', 'header'); ?>
            <article class="page-content">
                <?php the_content(); ?>
            </article>
        </section>
    <?php if (has_post_thumbnail(get_the_ID()) ):$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');?>
        <section class="block-content content-image" style="background-image: url(<?php echo $image[0]?>);"></section>
    <?php endif; ?>
    </section>
    <?php if(have_rows('columns')): ?>

    <ul class="block block-columns">
        <?php while( have_rows('columns') ): the_row();
            $title = get_sub_field('title');
            $content = get_sub_field('content');
        ?>
        <li class="block-content content-column">
            <?php if( $title ): ?>
				<header><?php echo $title; ?></header>
			<?php endif; ?>
            <?php if( $content ): ?>
				<section><?php echo $content; ?></section>
			<?php endif; ?>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>
<?php endwhile; ?>
