<?php /*
    Template Name: Tickets
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
            <ul class="list-items">
                <?php while( have_rows('list') ): the_row();
                    $label = get_sub_field('label');
                    $icon = get_sub_field('icon');
                ?>
                <li class="list-item">
                    <?php if( $icon ): ?>
                        <img class="icon style-svg" src="<?php echo $icon['url']; ?>" />
                    <?php endif; ?>
                    <?php if( $label ): ?>
                        <div class="label"><?php echo do_shortcode($label); ?></div>
                    <?php endif; ?>
                </li>
                <?php endwhile; ?>
            </ul>
        </section>
        <section class="block block-main block-main-content">
            <form class="create-event-ticket" method="post">
                <div class="repeatable-fields">
                    <input type="text" name="firstname_0">
                    <input type="text" name="lastname_0">
                    <input type="text" name="entreprise_0">
                    <input type="text" name="title_0">
                    <input type="text" name="email_0">
                    <input type="text" name="telephone_0">
                    <button class="remove-ticket-button" type="button">Enlever</button>
                </div>
                <div class="repeatable-fields">
                    <input type="text" name="firstname_1">
                    <input type="text" name="lastname_1">
                    <input type="text" name="entreprise_1">
                    <input type="text" name="title_1">
                    <input type="text" name="email_1">
                    <input type="text" name="telephone_1">
                    <button class="remove-ticket-button" type="button">Enlever</button>
                </div>
                <input type="hidden" name="quantity" value="1">
                <button type="submit" border="0">Yeah</button>
            </form>
            <button class="add-ticket-button" type="button">Ajouter un billet</button>
        </section>
        <?php var_dump(Extras\get_ticket_status()); ?>
    </div>
<?php endwhile; ?>
