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
                    $showTitle = get_sub_field('show_title') === true;
                    $titleStyle = get_sub_field('title_style');
                    $align = get_sub_field('align');
                    $hasSeparator = get_sub_field('has_separator') === true;
                    $titleUnderContent = get_sub_field('title_under_content') === true;
                    while(the_flexible_field('layout')):
                        $layout = get_row_layout(); ?>
        <section class="block block-main block-main-<?=$layout?> block-align-<?=$align?>" >

<?php                   if ($hasSeparator): ?>
            <div class="block block-separator"></div>
<?php                    endif; ?>

<?php                       if ($showTitle && !$titleUnderContent): ?>
            <div class="block block-title style-<?=$titleStyle?>"><?=$title?></div>
<?php                       endif; ?>

<?php                       switch( $layout): ?>
<?php                           case 'text': ?>
            <div class="block block-text"><?= the_sub_field('content')?>
            </div>
<?php                           break; ?>
<?php                           case 'text_with_image': // ----------------------------------------------------------
                                    $layoutContent = get_sub_field('content');
                                    $layoutImage = get_sub_field('image');
                                    $layoutAlign = get_sub_field('align');
                                    $layoutFullWidth = get_sub_field('is_full_width') === true;
                                    $layoutClassName = 'align-'.$layoutAlign.' '.($layoutFullWidth ? 'full-width':'not-full-width');
?>
            <div class="block block-text-with-image <?=$layoutClassName?>">
                <section class="block-content content-description">
                    <?= $layoutContent ?>
                </section>
                <?php if ($layoutImage):?>
                    <section class="block-content content-image" style="background-image: url(<?php echo $layoutImage['sizes']['large']?>);"></section>
                <?php endif; ?>
            </div>
<?php                           break; ?>
<?php                           case 'about': // ----------------------------------------------------------
                                    $layoutTitle = get_sub_field('title');
                                    $layoutContent = get_sub_field('content');
                                    $layoutImage = get_sub_field('image');
?>
            <div class="block block-about">
                <section class="block-content content-description">
                    <div class="content-description-inner">
                        <div class="page-header"><h1><?= $layoutTitle; ?></h1></div>
                        <article class="page-content"><?= $layoutContent ?></article>
                    </div>
                </section>
                <section class="block-content content-image" style="background-image: url(<?php echo $layoutImage['sizes']['large']?>);"></section>
            </div>
<?php                           break; ?>
<?php                           case 'contact_form': // ----------------------------------------------------------
                                    $formShortCode = get_sub_field( "form_shortcode");
                                    if($formShortCode): ?>
                                    <section class="block block-form">
                                        <?= do_shortcode($formShortCode); ?>
                                    </section>
<?php                               endif; ?>
<?php                           break; ?>
<?php                           case 'gallery':  // ----------------------------------------------------------
                                    $isFullWidth = get_sub_field('is_full_width') === true;
                                    $usesMaxWidth = get_sub_field('uses_max_width') === true;
                                    $style = get_sub_field('style');
                                    $backgroundSize = get_sub_field('background_size');
                                    $marginRight = get_sub_field('margin_right');
                                    $className = ' gallery-'.$style;
                                    $liAttrs = 'style="';
                                    $imgWidth = '100%';
                                    $withBackgroundColor = get_sub_field('with_background_color') === true;
                                    $imagePadding = get_sub_field('padding');
                                    $listItemsPadding = get_sub_field('list_items_padding');
                                    $listItemsStyle = 'text-align: '.$align.';padding:'.$listItemsPadding.';';
                                    $liAttrs .= 'padding: '.$imagePadding.';';

                                    if ($isFullWidth)
                                    {
                                        $className .= ' full-width';
                                        $columnsNumber = get_sub_field('columns_number');
                                        $liAttrs .= 'width:'.(1/$columnsNumber*100).'%; ';
                                        if ($style === 'details')
                                        {
                                            $imgWidth = get_sub_field('image_width');
                                        }

                                    } else {
                                        $className .= ' static-width';
                                        if ($style !== 'details')
                                        {
                                            $liAttrs .= 'width:'.get_sub_field('column_width').'px; ';
                                        }
                                        else
                                        {
                                            $imgWidth = get_sub_field('column_width').'px';
                                        }
                                        $liAttrs .= 'margin-right: '.$marginRight.'; ';
                                    }

                                    if ($usesMaxWidth)
                                    {
                                        $className .= ' uses-max-width';
                                    }

                                    if ($withBackgroundColor)
                                    {
                                        $className .= ' with-background-color';
                                    }
                                    $liAttrs .= 'height: '.get_sub_field('row_height').'px;"';
                                    $contentStyle = $style === 'details' ? 'padding-left: '.$imgWidth.';':';';
?>
            <div class="block block-gallery<?= $className ?>">
<?php                               if( have_rows('slides') ): ?>
                <ul class="list-items" style="<?= $listItemsStyle ?>">
    <?php                               while ( have_rows('slides') ) : the_row();
    					                   $title = get_sub_field('title');
    					                   $subtitle = get_sub_field('subtitle');
    					                   $itemContent = get_sub_field('content');
                                           $image = get_sub_field('image');
                                           $slideUrl = get_sub_field('link');
                                           $hideText = get_sub_field('hide_text');
                                           $imgStyle = 'background-image:url('.$image['sizes']['medium'].');  background-size:'.$backgroundSize.'; width:'.$imgWidth.';';
                                           $liClass = $image ? 'with-image':'without-image';
                                           $liClass .= $hideText ? ' hide-text':' show-text';
    					                   ?>
	                <li class="list-item <?= $liClass?>" <?=$liAttrs?> >
<?php                                       if (strlen($slideUrl)>0):?>
                        <a href="<?=$slideUrl?>" target="_blank">
<?php                                       endif; ?>
<?php                                       if ($image): ?>
                        <div class="item-image" style="<?=$imgStyle?>" ></div>
<?php                                       endif; ?>
                        <div class="item-content" style="<?=$contentStyle?>" >

                            <div class="item-content-inner">
                                <h1 class="item-element item-title"><?=$title?></h1>
                                <div class="item-element item-subtitle"><?=$subtitle?></div>
                                <div class="item-element item-description"><?=$itemContent?></div>
                            </div>
                        </div>
<?php                                       if (strlen($slideUrl)>0):?>
                        </a>
<?php                                       endif; ?>
                    </li>
<?php				                endwhile; ?>
                </ul>
<?php                           endif; ?>
            </div>
<?php                       break; ?>
<?php                       case 'columns_gallery': // ----------------------------------------------------------
                                $columnsHeight = get_sub_field('height');
                                if ( have_rows('columns') ):?>
                                    <section class="block block-columns-gallery">
<?php                               while ( have_rows('columns') ) : the_row();
                                        $columnTitle = get_sub_field('title');
                                    ?>
                                        <div class="block-content block-content-gallery-column">
                                            <h3 class="gallery-title" style="text-align: <?=$align?>;"><?=$columnTitle?></h3>
                                            <ul class="list-items" style="height: <?=$columnsHeight?>">
<?php
                                        $mapLinks = array();
                                        while(have_rows('links')): the_row();
                                            array_push($mapLinks, array(
                                                'title' => get_sub_field('title'),
                                                'link' => get_sub_field('link'),
                                                'style' => get_sub_field('style')
                                            ));
                                        endwhile;

                                        $elementImage = get_sub_field('image');

?>
                                            <li class="list-item" style="width: 100%; height:100%">
                                                <div class="item-image" style="background-image: url(<?=$elementImage['sizes']['medium']?>);">
<?php                                               foreach($mapLinks as $mapLink): ?>
                                                        <a href="<?=$mapLink['link']?>" alt="<?=$mapLink['title']?>" target="_blank" style="position: absolute; <?=$mapLink['style']?>"></a>
<?php                                               endforeach; ?>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
<?php				                endwhile; ?>
                                </section>
<?php                           endif; ?>
<?php                       break; ?>
<?php                   endswitch; ?>
<?php                   if ($showTitle && $titleUnderContent): ?>
            <div class="block block-title block-title-under-content style-<?=$titleStyle?>"><?=$title?></div>
<?php                   endif; ?>
        </section>
<?php               endwhile;
                endwhile;
            endif; ?>
    </div>
<?php endwhile; ?>
