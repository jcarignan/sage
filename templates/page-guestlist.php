<?php /*
    Template Name: Guestlist
    */

    use Roots\Sage\Extras;
?>

<?php while (have_posts()) : the_post();
    $loggedIn = is_user_logged_in();
    if ($loggedIn) {
        $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] :'';
        $direction = isset($_GET['direction']) ? $_GET['direction'] :'ASC';
        $orderByToUse = $orderBy === 'name' ? 'first_name':$orderBy;

        $ticketsOriginal = Extras\get_tickets($orderByToUse, $direction);
        $tickets = array();
        foreach($ticketsOriginal as $ticketOriginal){
            $ticket = array();
            foreach($ticketOriginal as $key => $value){
                $ticket[$key] = $value;
                if ($key == 'last_name')
                {
                    $ticket['name'] = $ticketOriginal['first_name'].' '.$ticketOriginal['last_name'];
                }

                if ($key == 'user_agent' && strlen($ticket[$key]))
                {
                    $browser = Extras\get_browser_from_useragent($ticket[$key]);
                    $ticket['user_agent'] = $browser->getPlatform().' '.$browser->getBrowser().' '.$browser->getVersion();
                }

                if ($key == 'qr_code')
                {
                    $ticket['send_ticket'] = $ticket['qr_code'];
                }
            }
            array_push($tickets, $ticket);
        }
        $paidTickets = 0;
        $scannedTickets = 0;
        foreach($tickets as $ticket) {
            if ($ticket['paid'] == 1)
            {
                $paidTickets++;
            }
            if ($ticket['scanned'] == 1)
            {
                $scannedTickets++;
            }
        }
        $lastInvoice = '';
    }


?>
    <div class="block-main-container">
        <section class="block block-main block-main-content">
            <?php if (!$loggedIn):?>
                <?php wp_login_form(get_permalink()); ?>
            <?php else:?>
                <div class="tickets-infos">
                    <div class="confirmed">
                        <?= __('Confirmed', 'immersiveproductions').'s: '.$paidTickets; ?>
                    </div>
                    <div class="potential">
                        <?= __('Potential', 'immersiveproductions').'s: '.(count($tickets) - $paidTickets); ?>
                    </div>
                    <div class="scanned">
                        <?= __('Scanned', 'immersiveproductions').'s: '.$scannedTickets; ?>
                    </div>
                </div>
                <div class="tickets-data">
                    <table border="1">
                        <?php foreach ($tickets as $ticketCount => $ticket): ?>
                            <?php if ($ticketCount === 0): ?>
                                <tr>
                                    <?php foreach ($ticket as $fieldKey => $fieldValue): ?>
                                        <td class="column-name <?=$fieldKey?>">
                                            <a href="<?=get_permalink()?>?orderby=<?=$fieldKey?>&direction=<?=$orderBy === $fieldKey && $direction === 'ASC' ? 'DESC':'ASC'?>"><?=$fieldKey?></a>
                                        </td>
                                    <?php endforeach;?>
                                </tr>
                            <?php endif;?>
                            <tr class="<?=$ticket['paid'] == 0 ? 'ticket-unpaid':'ticket-paid'?>" style="border-top: <?=$lastInvoice === $ticket['invoice']?'0':'4px solid black;'?>">
                                <?php foreach ($ticket as $fieldKey => $fieldValue): ?>
                                    <td class="field <?=$fieldKey?>">
                                    <?php if ($fieldKey === 'paid' || ($fieldKey === 'scanned' && ($fieldValue == 0 || $fieldValue == 1))): ?>
                                        <input type="checkbox" disabled <?php checked( $fieldValue, 1); ?>>
                                    <?php elseif ($fieldKey === 'send_ticket'): ?>
                                        <?php if ($ticket['paid'] == 1): ?>
                                            <button class="email-qr-code" type="button" data-qrcode="<?=$fieldValue?>">Email</button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?=stripcslashes($fieldValue);?>
                                    <?php endif; ?>
                                    </td>
                                <?php endforeach;?>
                            </tr>
                            <?php $lastInvoice = $ticket['invoice'];?>
                        <?php endforeach;?>
                    </table>
                </div>
            <?php endif;?>
        </section>
    </div>
<?php endwhile; ?>
