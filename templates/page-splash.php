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
    $youtubeLoop = get_field('youtube_loop');
    $youtubeWidth = get_field('youtube_width');
    $youtubeHeight = get_field('youtube_height');
    $imageStyle = '';
    $blockMainClasses = 'block block-main'.($youtubeId ? ' block-main-with-video':'');

    $youtubeUrl = "http://www.youtube.com/embed/".$youtubeId.'?autoplay=1&controls=1&modestbranding=1&rel=0&showinfo=0&enablejsapi=1';
    if ($youtubeLoop == 1)
    {
        $youtubeUrl .= "&loop=1&playlist=".$youtubeId;
    }

    $videoStyle = "width: ".$youtubeWidth."%; padding-bottom: ".$youtubeHeight."%;";
?>
    <div class="block-main-container">
        <section class="<?=$blockMainClasses?>" >
            <section class="splash-container">
                <?php if( $youtubeId ): ?>
                    <div class="video-container" style="<?=$videoStyle?>">
                        <iframe name="youtubeFrame" width="640" height="360" src="<?=$youtubeUrl?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <img src="<?= $image['url'] ?>" alt="splash-image" width="<?=$image['width']?>" height="<?=$image['height']?>" />
                <div class="splash-tagline"><?=$tagline?></div>
            </section>
            <section class="main-content">
                <ul class="list-items">
                    <?php while( have_rows('list') ): the_row();
                        $label = get_sub_field('label');
                        $icon = get_sub_field('icon');
                        $link = get_sub_field('link');
                        $metadata = get_sub_field('metadata');
                    ?>
                        <li class="list-item">
                            <?php if ($link): ?><a href="<?=$link?>"><?php endif; ?>
                                <?php if( $icon ): ?>
                                    <img class="icon style-svg" src="<?=$icon['url'];?>" />
                                <?php endif; ?>
                                <?php if( $label ): ?>
                                    <div class="label"><?=do_shortcode($label);?></div>
                                <?php endif; ?>
                            <?php if ($link): ?></a><?php endif; ?>
                            <?php if( $metadata ): ?>
                                <div class="metadata"><?=do_shortcode($metadata);?></div>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="main-description"><?php the_content(); ?></div>
            </section>
        </section>
    </div>
<?php endwhile; ?>
