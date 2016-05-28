<?php /*
    Template Name: Thankyou
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    //$image = get_field('image');
    //$tagline = get_field('tagline');

?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <div class="content-description"><?php the_content(); ?></div>
            <?php var_dump($_GET); ?>
            <?php var_dump($_POST); ?>
        </section>
    </div>
<?php endwhile; ?>
