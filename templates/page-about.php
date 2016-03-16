<?php /*
    Template Name: About
    */
?>

<?php while (have_posts()) : the_post(); ?>
<?php
    $post = get_post();
    $id = ! empty( $post ) ? $post->ID : false;
    $image = $id !== false ? get_field('about_image', $id):false;
?>
    <section class="block block-main">
        <section class="block-content content-description">
            <?php get_template_part('templates/page', 'header'); ?>
            <article class="page-content">
                <?php the_content(); ?>
            </article>
        </section>
<?php if ($image) { ?>
        <section class="block-content content-image" data-title="<?php echo $image['title'] ?>" style="background-image: url(<?php echo $image['url']?>);"></section>
<?php } ?>
    </section>
<?php
    $i = 1;
    $strTitle = get_field('column_'.$i.'_title', $id);
    $strContent = get_field('column_'.$i.'_content', $id);
    while ($strTitle && $strContent) {
        if ($i === 1){
?>
    <section class="block block-columns">
<?php
        }
?>
        <section class="block-content content-step">
            <div class="step-number"><?= $i ?></div>
            <div class="step-title"><?= $strTitle ?></div>
            <div class="step-content"><?= $strContent ?></div>
        </section>
<?php
        $i++;
        $strTitle = get_field('column_'.$i.'_title', $id);
        $strContent = get_field('column_'.$i.'_content', $id);
    }
    if (i > 1) {
?>
    </section>
<?php
    }
?>

<?php

?>
    </div>
    <div class="bottom-content">
<?php endwhile; ?>
