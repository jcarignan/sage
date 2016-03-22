<?php /*
    Template Name: Multicontent
    */
?>

<?php while (have_posts()) : the_post(); ?>
    <?php
        if( have_rows('multicontent') ):
            $mainBlocksCount = 0;
            while (have_rows('multicontent')) : the_row();
                $withContent = get_sub_field('with_content');
                $list = get_sub_field('list');
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                $image = get_sub_field('image');
                $evenOrOdd = $mainBlocksCount % 2 === 0 ? 'even':'odd';
                if ($withContent)
                {
                    $blockClass = 'block-main block-main-'.$evenOrOdd;
                    $mainBlocksCount++;
                }
                else
                {
                    $blockClass = 'block-without-content';
                }

                ?>

                <section class="block <?php echo $blockClass;?>">
                    <?php if ($withContent): ?>
                        <section class="block-content content-description">
                            <div class="page-header"><h1><?php echo $title; ?></h1></div>
                            <article class="page-content"><?php echo $content ?></article>
                    <?php endif; ?>
                            <ul class="list-items">
                                <?php while( have_rows('list') ): the_row();
                                    $label = get_sub_field('label');
                                    $icon = get_sub_field('icon');
                                ?>
                                <li class="list-item">
                                    <?php if( $icon ): ?>
                        				<img class="icon" src="<?php echo $icon['url']; ?>" />
                        			<?php endif; ?>
                                    <?php if( $label ): ?>
                        				<div class="label"><?php echo $label; ?></div>
                        			<?php endif; ?>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                    <?php if ($withContent): ?>
                        </section>
                        <section class="block-content content-image" style="background-image: url(<?php echo $image['url']?>);"></section>
                    <?php endif; ?>
                </section>
        <?php endwhile; ?>
    <?php endif; ?>
<?php endwhile; ?>
