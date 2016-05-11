<?php /*
    Template Name: Accro - about
    */
?>

<?php while (have_posts()) : the_post();
        if( have_rows('multicontent') ): ?>
        <section class="section-multicontent">
        <?php
            $mainBlocksCount = 0;
            while (have_rows('multicontent')) : the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                $image = get_sub_field('image');
                $evenOrOdd = $mainBlocksCount % 2 === 0 ? 'even':'odd';
                $blockClass = 'block-main block-main-'.$evenOrOdd;
                $mainBlocksCount++;
?>
                <section class="block <?php echo $blockClass;?>">
                    <section class="block-content content-description">
                        <div class="page-header"><h1><?php echo $title; ?></h1></div>
                        <article class="page-content"><?php echo $content ?></article>
                    </section>
                    <section class="block-content content-image" style="background-image: url(<?php echo $image['url']?>);"></section>
                </section>
        <?php endwhile; ?>
        </section>
    <?php endif; ?>
<?php endwhile; ?>
