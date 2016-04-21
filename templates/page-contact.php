<?php /*
    Template Name: Contact
    */

    $imageUrl
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="block-main-container">
        <section class="block block-main">
            <?php
                $contentDescriptionAttrs = '';
                if (has_post_thumbnail(get_the_ID()) ){
                    $imageUrl = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                    $contentDescriptionAttrs = 'style="background-image: url('.$imageUrl[0].'");"';
                }
            ?>
            <section class="block-content content-description" <?=$contentDescriptionAttrs?>>
                <article class="page-content">
                    <?php the_content(); ?>
                </article>
                <article class="page-infos" itemscope itemtype="http://schema.org/Organization">
                    <?php if ($name = get_field('name')): ?>
                        <h1 itemprop="founder"><?= $name; ?> </h1>
                    <?php endif; ?>
                    <?php if ($label = get_field('label')): ?>
                        <div itemprop="jobTitle"><?= $label; ?> </div>
                    <?php endif; ?>
                    <?php if ($phoneNumber = get_field('phone_number')): ?>
                        <div itemprop="telephone"><a href="tel:+1-<?= preg_replace('/\D/', '-', $phoneNumber); ?>"><?=$phoneNumber;?></a></div>
                    <?php endif; ?>
                    <?php if ($email = get_field('email')): ?>
                        <div itemprop="email"><a href="mailto:<?= $email; ?>"><?= $email; ?></a></div>
                    <?php endif; ?>
                </article>
            </section>
        </section>
    </div>
    <?php if(true): ?>

    <section class="block block-form">
        <?= do_shortcode('[contact-form-7 id="314" title="Contact"]'); ?>
    </section>
    <?php endif; ?>
<?php endwhile; ?>
