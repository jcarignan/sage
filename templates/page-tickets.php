<?php /*
    Template Name: Tickets
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    //$image = get_field('image');
    //$tagline = get_field('tagline');
    $ticketStatus = Extras\get_ticket_status();
    $ticketImage = get_field('ticket_image');
    $labels = $ticketStatus['labels'];
    $firstBlockLabel;
    if ($ticketStatus['promo_active']){
        $firstBlockLabel = $labels['promo'];
    } else if ($ticketStatus['early_active']){
        $firstBlockLabel = $labels['early'];
    } else {
        $firstBlockLabel = $labels['normal'];
    }
    $secondBlockLabel = $labels['combo'];
?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <div class="content-description"><?php the_content(); ?></div>
        </section>
        <section class="block block-main block-main-ticketinfos">
            <div class="block-content content-image" style="background-image: url(<?=$ticketImage['url']?>)">
                <div class="content-text"><?= get_field('ticket_text'); ?></div>
            </div>
            <div class="block-content content-infos-container <?=$ticketStatus['promo_active']?'with-one-info':'with-two-infos'?>">
                <div class="content-infos">
                    <h1><?=$firstBlockLabel?></h1>
                    <div class="price"><?= do_shortcode('[current_price]')?></div>
                    <span class="per-ticket-label"></span>
                    <span class="tax-label">+<?=__('taxes', 'immersiveproductions')?></span>
                    <div class="asterisk"><?= do_shortcode(get_field('promo_asterisk')); ?></div>
                </div>
                <?php if (!$ticketStatus['promo_active']): ?>
                    <div class="content-infos">
                        <h1><?=$secondBlockLabel?></h1>
                        <div class="price"><?= do_shortcode('[combo_price]')?></div>
                        <span class="per-ticket-label">/<?=__('ticket', 'immersiveproductions')?></span>
                        <span class="tax-label">+<?=__('taxes', 'immersiveproductions')?></span>
                        <div class="asterisk"><?= do_shortcode(get_field('combo_asterisk')); ?></div>
                    </div>
                <?php endif;?>
            </div>
        </section>

        <section class="block block-main block-main-content">
            <div class="block block-separator"></div>
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
        <section class="block block-main block-form">
            <form class="create-event-ticket" method="post">
                <div class="repeatable-sets">
                    <div class="repeatable-set">
                        <div class="ticket-title" data-label-first="<?=__('Ticket', 'immersiveproductions')?>" data-label-second="<?=__('of', 'immersiveproductions')?>"><?=__('Ticket', 'immersiveproductions').' #1'?></div>
                        <?php while ( have_rows('input_fields') ) : the_row(); ?>
                            <span class="wpcf7-form-control-wrap">
                                <input type="<?=get_sub_field('type')?>" name="<?=get_sub_field('name')?>_0" placeholder="<?=get_sub_field('placeholder')?>">
                            </span>
                        <?php endwhile; ?>
                        <button class="remove-ticket-button" type="button"><?=__('Remove', 'immersiveproductions')?></button>
                    </div>

                </div>
                <input type="hidden" name="quantity" value="1">
                <div class="tickets-controls">
                    <div class="buttons-container">
                        <button class="add-ticket-button" type="button"><?=__('Add ticket', 'immersiveproductions')?></button>
                    </div>
                    <div class="tickets-invoice-container">
                        <div class="tickets-invoice">
                            <div class="invoice-row row-subtotal">
                                <div class="invoice-cell cell-label"><?=__('Subtotal', 'immersiveproductions')?></div>
                                <div class="invoice-cell cell-price">0</div>
                            </div>
                            <div class="invoice-row row-tps">
                                <div class="invoice-cell cell-label"><?=__('PST', 'immersiveproductions')?></div>
                                <div class="invoice-cell cell-price">0</div>
                            </div>
                            <div class="invoice-row row-tvq">
                                <div class="invoice-cell cell-label"><?=__('QST', 'immersiveproductions')?></div>
                                <div class="invoice-cell cell-price">0</div>
                            </div>
                            <div class="invoice-row row-total">
                                <div class="invoice-cell cell-label"><?=__('Total', 'immersiveproductions')?></div>
                                <div class="invoice-cell cell-price">0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="wpcf7-form-control wpcf7-submit" type="submit" border="0"><?=__('Pay with', 'immersiveproductions')?><img src="<?=get_template_directory_uri()?>/dist/images/icons/paypal.svg" alt="Paypal"></button>
                <img class="ajax-loader" src="<?=get_template_directory_uri()?>/dist/images/icons/ajax-loader.gif" alt="Envoi en cours ..." style="visibility: hidden;">
                <div class="wpcf7-response-output wpcf7-validation-errors" role="alert" style="visibility: hidden;">Un ou plusieurs champs sont vides. Veuillez vérifier et réessayer.</div>
            </form>
        </section>
    </div>
<?php endwhile; ?>
