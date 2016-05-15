<?php /*
    Template Name: Accro - about
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <?php if( have_rows('multicontent') ): ?>
        <section class="section-multicontent">
            <?php
                $count = 0;
                while (have_rows('multicontent')) : the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                $image = get_sub_field('image');
                $evenOrOdd = $count % 2 === 0 ? 'even':'odd';
                $blockClass = 'block block-main block-main-'.$evenOrOdd;
                $count++;
            ?>
            <section class="<?php echo $blockClass;?>">
                <section class="block-content content-description">
                    <div class="page-header"><h1><?= $title; ?></h1></div>
                    <article class="page-content"><?= $content ?></article>
                </section>
                <section class="block-content content-image" style="background-image: url(<?php echo $image['url']?>);"></section>
            </section>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>
    <?php if( have_rows('dual_tiles') ): ?>
        <section class="section-dual-tiles">
            <?php
                while (have_rows('dual_tiles')) : the_row();
                    $title = get_sub_field('title');
                    $image = get_sub_field('image');
            ?>
            <section class="block block-dual-tile">
                <section class="block-content content-description">
                    <div class="page-header"><h1><?= $title; ?></h1></div>
                </section>
                <section class="block-content content-image" style="background-image: url(<?php echo $image['url']?>);"></section>
            </section>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <section class="section-about-event">
        <ul class="list-items">
            <?php while( have_rows('event_infos') ): the_row();
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

    <section class="section-about-immersive">
        <?php if( get_field('title') ): ?>
            <h1 class="immersive-title">
    	        <?php the_field('title'); ?>
            </h1>
        <?php endif; ?>
        <section class="block block-main">
            <section class="block-content content-description">
                <?php the_content(); ?>
            </section>
            <?php if (has_post_thumbnail(get_the_ID()) ):$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');?>
                <section class="block-content content-image" style="background-image: url(<?php echo $image[0]?>);"></section>
            <?php endif; ?>
    </section>
<?php endwhile; ?>
