<?php /*
    Template Name: Splash
    */
?>

<?php while (have_posts()) : the_post();
    $image = get_field('image');
    $tagline = get_field('tagline');
    $link = get_field('link');
    $linkBoxOffice = get_field('link_boxoffice');
    $youtubeId = get_field('youtube_id');
    $imageStyle = '';
    $blockMainClasses = 'block block-main'.($youtubeId ? ' block-main-with-video':'');
?>
    <div class="block-main-container">
        <section class="<?=$blockMainClasses?>" >
            <section class="splash-container">
                <?php if( $youtubeId ): ?>
                    <div class="video-container">
                        <iframe name="youtubeFrame" width="640" height="360" src="http://www.youtube.com/embed/<?=$youtubeId?>?playlist=<?=$youtubeId?>&autoplay=1&loop=1&controls=1&modestbranding=1&rel=0&showinfo=0&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <img src="<?= $image['url'] ?>" alt="splash-image" width="<?=$image['width']?>" height="<?=$image['height']?>" />
                <div class="splash-tagline"><?=$tagline?></div>
            </section>
            <section class="main-content">
                <div class="main-description"><?php the_content(); ?></div>
                <ul class="list-items">
                    <?php while( have_rows('list') ): the_row();
                        $label = get_sub_field('label');
                        $icon = get_sub_field('icon');
                        $link = get_sub_field('link');
                    ?>
                        <li class="list-item">
                            <?php if ($link): ?><a href="<?=$link?>"><?php endif; ?>
                                <?php if( $icon ): ?>
                                    <img class="icon style-svg" src="<?=$icon['url'];?>" />
                                <?php endif; ?>
                                <?php if( $label ): ?>
                                    <div class="label"><?=do_shortcode($label);?></div>
                                <?php endif; ?>    <?php if ($link): ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </section>
    </div>
<?php endwhile; ?>
