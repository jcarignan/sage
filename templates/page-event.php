<?php /*
    Template Name: Event
    */
?>

<?php while (have_posts()) : the_post(); ?>

    <div class="block-main-container">

<?php       if (strlen(get_the_content())): ?>

        <section class="block block-main block-main-content">
            <section class="block-content content-description">
                <article class="page-content">
<?php               the_content(); ?>
                </article>
            </section>
        </section>

<?php       endif; ?>

<?php       if( have_rows('content') ): ?>
<?php           while ( have_rows('content') ) : the_row(); ?>
<?php               $title = get_sub_field('title');
                    $align = get_sub_field('align');
                    $hasSeparator = get_sub_field('has_separator') === true;
                    while(the_flexible_field('layout')):
                        $layout = get_row_layout(); ?>
        <section class="block block-main block-main-<?=$layout?>">

<?php                   if ($hasSeparator): ?>
            <div class="block block-separator"></div>
<?php                    endif; ?>

<?php                       if ($title): ?>
            <h1 class="block block-title align-<?=$align?>"><?=$title?></h1>
<?php                       endif; ?>

<?php                       switch( $layout): ?>
<?php                           case 'text': ?>
            <div class="block block-text"><?= the_sub_field('content')?>
            </div>
<?php                           break; ?>
<?php                           case 'text_with_photo': ?>
            <div class="block block-text-with-photo">
                <div class="content-text"><?= the_sub_field('content')?></div>
                <div class="content-image"></div>
            </div>
<?php                           break; ?>
<?php                           case 'social_medias': ?>
            <div class="block block-social-medias"><?= the_sub_field('content')?></div>
<?php                           break; ?>
<?php                           case 'gallery':
                                    $isFullWidth = get_sub_field('is_full_width') === true;
                                    $style = get_sub_field('style');
                                    $backgroundSize = get_sub_field('background_size');
                                    $className = ' gallery-'.$style;
                                    $liAttrs = 'style="';
                                    $imgWidth = '100%';
                                    $withBackgroundColor = get_sub_field('with_background_color') === true;
                                    if ($isFullWidth)
                                    {
                                        $className .= ' full-width';
                                        $columnsNumber = get_sub_field('columns_number');
                                        $liAttrs .= 'width:'.(1/$columnsNumber*100).'%; ';
                                    } else {
                                        $className .= ' static-width';
                                        if ($style !== 'details')
                                        {
                                            $liAttrs .= 'width:'.get_sub_field('column_width').'px; ';
                                        }
                                        else
                                        {
                                            $imgWidth = get_sub_field('column_width').'px;';
                                        }
                                    }
                                    if ($withBackgroundColor)
                                    {
                                        $className .= ' with-background-color';
                                    }
                                    $liAttrs .= 'height: '.get_sub_field('row_height').'px;";';
?>
            <div class="block block-gallery<?= $className ?>">
<?php                               if( have_rows('slides') ): ?>
                <ul class="list-items">
<?php                               while ( have_rows('slides') ) : the_row();
					                   $title = get_sub_field('title');
					                   $subtitle = get_sub_field('subtitle');
                                       $image = get_sub_field('image');
                                       $imgStyle = 'background-image:url('.$image['url'].');  background-size:'.$backgroundSize.'; width:'.$imgWidth.';';
					                   ?>
	                <li class="list-item" <?=$liAttrs?>>
                        <div class="item-image" style="<?=$imgStyle?>" ></div>
                        <div class="item-content">
                            <h1 class="item-title"><?=$title?></h1>
                            <div class="item-subtitle"><?=$subtitle?></div>
                        </div>
                    </li>
<?php				                endwhile; ?>
                </ul>
<?php                           endif; ?>
            </div>
<?php                       break; ?>
<?php                   endswitch; ?>
        </section>
<?php               endwhile;
                endwhile;
            endif; ?>
    </div>
<?php endwhile; ?>
