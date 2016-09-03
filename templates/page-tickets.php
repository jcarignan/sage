<?php /*
    Template Name: Tickets
    */
    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    //$image = get_field('image');
    //$tagline = get_field('tagline');
    $ticketStatus = Extras\get_ticket_status();
    $ticketText = get_field('ticket_text');
    $ticketImage = get_field('ticket_image');
    $labels = $ticketStatus['labels'];
    $firstBlockLabel;
    $firstBlockAsterisk;

    if ($ticketStatus['coupon_active']){
        $firstBlockLabel = $labels['coupon'];
        $firstBlockAsterisk = get_field('coupon_asterisk');
        $ticketText = get_field('ticket_text_coupon');
    } else if ($ticketStatus['promo_active']){
        $firstBlockLabel = $labels['promo'];
        $firstBlockAsterisk = get_field('promo_asterisk');
    } else if ($ticketStatus['early_active']){
        $firstBlockLabel = $labels['early'];
        $firstBlockAsterisk = get_field('early_asterisk');
    } else {
        $firstBlockLabel = $labels['normal'];
        $firstBlockAsterisk = get_field('normal_asterisk');
        $ticketText = get_field('ticket_text_normal');
    }
    $secondBlockLabel = $labels['combo'];
    $showTwoContents = !$ticketStatus['promo_active'] && (!$ticketStatus['coupon_active'] || $ticketStatus['price'] > $ticketStatus['combo_price']);
?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <div class="content-description"><?php the_content(); ?></div>
        </section>
        <section class="block block-main block-main-ticketinfos">
            <div class="block-content content-image" style="background-image: url(<?=$ticketImage['url']?>)">
                <div class="content-text"><?= $ticketText ?></div>
            </div>
            <div class="block-content content-infos-container <?=!$showTwoContents?'with-one-content':'with-two-contents'?>">
                <div class="content-infos">
                    <h1><?=$firstBlockLabel?></h1>
                    <div class="price-container">
                        <div class="price-content">
                            <div class="price-content-inner">
                                <div class="price"><?= do_shortcode('[current_price]')?></div>
                                <div class="price-details">
                                    <div class="per-ticket-label"></div>
                                    <div class="tax-label">+<?=__('taxes', 'immersiveproductions')?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="asterisk">
                        <div class="asterisk-content">
                            <?= do_shortcode($firstBlockAsterisk); ?>
                        </div>
                    </div>
                </div>
                <?php if ($showTwoContents): ?>
                    <div class="content-infos">
                        <h1><?=$secondBlockLabel?></h1>
                        <div class="price-container">
                            <div class="price-content">
                                <div class="price-content-inner">
                                    <div class="price"><?= do_shortcode('[combo_price]')?></div>
                                    <div class="price-details">
                                        <div class="per-ticket-label">/&nbsp;<?=__('ticket', 'immersiveproductions')?></div>
                                        <div class="tax-label">+<?=__('taxes', 'immersiveproductions')?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="asterisk">
                            <div class="asterisk-content">
                                <?= do_shortcode(get_field('combo_asterisk')); ?>
                            </div>
                        </div>
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
                <div class="buttons-container">
                    <span class="wpcf7-form-control-wrap">
                        <button class="add-ticket-button" type="button">+ <?=__('Add ticket', 'immersiveproductions')?></button>
                    </span>
                    <span class="wpcf7-form-control-wrap">
                        <button class="wpcf7-form-control wpcf7-submit" type="submit" border="0"><?=__('Register', 'immersiveproductions')?></button>
                    </span>
                </div>
                <div class="loading-gif">
                    <img class="ajax-loader" src="<?=get_template_directory_uri()?>/dist/images/icons/ajax-loader.gif" alt="Envoi en cours ..." style="visibility: hidden;">
                </div>
                <div class="wpcf7-response-output wpcf7-validation-errors" role="alert" style="visibility: hidden;">
                    <?=__('One or more fields have an error. Please check and try again.', 'immersiveproductions');?>
                </div>
                <div class="payment-methods-container">
                    <img class="payment-methods" src="<?=get_template_directory_uri()?>/dist/images/paypal-payment-methods.png" alt="Paypal Payment methods">
                </div>

            </form>
            <form class="paypal-hidden" action="https://www.paypal.com/cgi-bin/webscr" target="_top" style="visibility:hidden;width:0;height:0;">
                <input type="submit" name="btnSubmit">
            </form>
        </section>
    </div>
<?php endwhile; ?>
